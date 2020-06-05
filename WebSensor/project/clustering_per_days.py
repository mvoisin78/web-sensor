import collections
import os
from sklearn.datasets import fetch_20newsgroups
from sklearn.decomposition import TruncatedSVD
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.feature_extraction.text import HashingVectorizer
from sklearn.feature_extraction.text import TfidfTransformer
from sklearn.pipeline import make_pipeline
from sklearn.preprocessing import Normalizer
from sklearn import metrics

from sklearn.cluster import KMeans, MeanShift, DBSCAN,estimate_bandwidth

import logging
from optparse import OptionParser
import sys

import numpy as np
from pymongo import MongoClient

from testNLP import *
from connectMongo import *

from time import time

def subject(sentence,features):
        subject =""
        tokens = normalize_corpus(sentence)
        for i in range(len(features)):
                if features[i] in tokens :
                        subject += features[i] + " "
        return subject

def getMaxFollowerTweet(tweet_id,followers_count) :
    idMax = followers_count.index(max(followers_count))
    return tweet_id[idMax]

_complete_dataset = selectAll()

dataset=_complete_dataset['text']

max_features = len(dataset)*0.005
tfidf_vectorizer = TfidfVectorizer(tokenizer=normalize_corpus,ngram_range=(1,4),max_features=int(max_features))

X = tfidf_vectorizer.fit_transform(dataset).toarray()

vocabulary = tfidf_vectorizer.get_feature_names()

ml = DBSCAN(eps=0.4, min_samples=50)
ml.fit(X)

n_clusters_ = len(set(ml.labels_)) - (1 if -1 in np.unique(ml.labels_) else 0)
n_noise_ = list(ml.labels_).count(-1)

_cluster_info = {}

for i in range(n_clusters_):
    _cluster_info['cluster'+str(i)+'_tweets']=[]
    _cluster_info['cluster'+str(i)+'_followers_count']=[]
    _cluster_info['cluster'+str(i)+'user_id']=[]

clusters = collections.defaultdict(list)
for i, label in enumerate(ml.labels_):
    clusters[label].append(i)


total_data = {key :0 for key in range(n_clusters_)}
total_feature = {}
pourcentage = {key :[] for key in range(n_clusters_) }

clusters = dict(clusters)
for cluster in range(n_clusters_):
    for i,sentence in enumerate(clusters[cluster]):

        _cluster_info['cluster'+str(cluster)+'_tweets'].append(_complete_dataset['tweet_id'][dataset.index(dataset[sentence])])
        _cluster_info['cluster'+str(cluster)+'_followers_count'].append(_complete_dataset['followers_count'][dataset.index(dataset[sentence])])
        _cluster_info['cluster'+str(cluster)+'user_id'].append(_complete_dataset['user_id'][dataset.index(dataset[sentence])])
         
        w=subject(dataset[sentence],vocabulary)
        if total_feature.get(w) == None :
                total_feature[w] = 1
                total_data[cluster]+=1
        else :
                total_feature[w] += 1
                total_data[cluster]+=1
                
    pourcentage[cluster].append(total_feature.copy())
    
    total_feature.clear()
    _cluster_info['cluster'+str(cluster)+'_famousTweetsID']=getMaxFollowerTweet(_cluster_info['cluster'+str(cluster)+'_tweets'],_cluster_info['cluster'+str(cluster)+'_followers_count'])
    _cluster_info['cluster'+str(cluster)+'_famousUserID']=getMaxFollowerTweet(_cluster_info['cluster'+str(cluster)+'_tweets'],_cluster_info['cluster'+str(cluster)+'_user_id'])

print(_cluster_info)

for cluster in pourcentage :
    for key in pourcentage[cluster] :
        lastlen = 999
        for char in key :
            key[char] = "{:.1f}".format((key[char]/total_data[cluster])*100)
            if len(char) <= lastlen:
                lastlen = len(char)
                bestChar = char
        print(bestChar)    
