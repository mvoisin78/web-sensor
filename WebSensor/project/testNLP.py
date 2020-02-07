import spacy
import string


import pandas as pd
import numpy as np
import nltk
from nltk.tokenize import sent_tokenize, word_tokenize
from nltk.tokenize import TweetTokenizer
from nltk.tokenize.toktok import ToktokTokenizer
from nltk.corpus import stopwords
import re
from bs4 import BeautifulSoup
import unicodedata
import dateutil.parser as dparser

nlp = spacy.load("fr_core_news_sm", parse=True, tag=True, entity=True)

text = u'Super le Match de Foot du 15 mars à 18h au Stade de France et Tremblement de Terre, Concert de Musique et mangez vos grand morts :) :3'
#text = u'Tous les films de Ghibli chez Netflix'

def token(sentence): #Tokenize et retourne les labels
    doc = nlp(sentence)
    return [(X.text, X.label_) for X in doc.ents]

def remove_accented_chars(text):
    text = unicodedata.normalize('NFKD', text).encode('ascii', 'ignore').decode('utf-8', 'ignore')
    return text

def remove_special_characters(text, remove_digits=False):
    pattern = r'[^a-zA-z0-9\s]' if not remove_digits else r'[^a-zA-z\s]'
    text = re.sub(pattern, '', text)
    return text

def lemmatize_text(text):
    text = nlp(text)
    text = ' '.join([word.lemma_ if word.lemma_ != '-PRON-' else word.text for word in text])
    return text


def normalize_corpus(text):
    normalize_text = remove_accented_chars(text)
    normalize_text = remove_special_characters(normalize_text)
    normalize_text = lemmatize_text(normalize_text)
    return normalize_text

    return normalized_corpus

def remove_stopwords(text):
    stopword_list = stopwords.words('french')
    tokens = word_tokenize(text)
    tokensWithoutPunc = [word for word in tokens if word not in stopword_list]
    filtered_text = ' '.join(tokensWithoutPunc)
    return filtered_text


normalize_text = normalize_corpus(text)
final_text = remove_stopwords(normalize_text)
print(final_text)
print(token(final_text))


#print(remove_stopwords("The, and, if are stopwords, computer is not"))
#print(normalize_corpus(text))

