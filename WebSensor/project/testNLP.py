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

#text = u'Super le Match de Foot du 15 mars à 18h au Stade de France et Tremblement de Terre, Concert de Musique et mangez vos grand morts :) :3'
text = u"Il faut rester confiné à cause du coronavirus c'est pas cool du tout :("
#text = u'Sport = FootBall, Athlétisme, basketball, natation, cyclisme, golf, handball, equitation, judo, karate, marathon, rugby, ski, taekwondo, volleyball, superbowl, formule Type = Match, coupe, championnat, Attentat, Tremblement, Concert, Exposition, Explosion, Festival, terroriste, election, fête, cirque, gala, oscar, cesar, congrès, forum, ceremonie, convention, spectacle, théâtre, politique, trianon, vote, election, accident, mort, sortie, album, cinema, film, coronavirus, virus, maladie, épidémie, pandémie,  nouveau, soldes, carnaval, tsunami, avant-premiere, defile, musique, show, comedie, humour, stand-up, ligue, onemanshow, opera, evenement, event, manifestation, vernissage, oeuvre, game, fashion, foire, Lieu = France, Europe, Monde, National, Regionnal, Zenith, Olympia, Bataclan, Hippodrome, cinema, theatre, Arena, trianon, musee, villette, opera, casino, '

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
    for token in text:
        print(token,token.lemma_)
    text = ' '.join([word.lemma_ if word.lemma_ != '-PRON-' else word.text for word in text])
    return text


def normalize_corpus(text):
    normalize_text = lemmatize_text(text)
    normalize_text = remove_accented_chars(normalize_text)
    normalize_text = remove_special_characters(normalize_text)
    normalize_text = lemmatize_text(normalize_text)
    normalize_text = remove_stopwords(normalize_text)
    return normalize_text

def remove_stopwords(text):
    stopword_list = stopwords.words('french')
    tokens = word_tokenize(text)
    tokensWithoutPunc = [word for word in tokens if word not in stopword_list]
    filtered_text = ' '.join(tokensWithoutPunc)
    return filtered_text


print(normalize_corpus(text))
#print("---------------")
#print(normalize_corpus("Bonjour j'ai le coronavirus mdr"))
#print("--------------")
#print(normalize_corpus("coronavirus"))

#print(remove_stopwords("The, and, if are stopwords, computer is not"))
#print(normalize_corpus(text))

