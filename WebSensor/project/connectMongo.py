from pymongo import MongoClient
import json
#pour terminal mongo
#cd C:\Program Files\MongoDB\Server\4.2\bin
#mongod
#(dans un autre terminal)
#cd C:\Program Files\MongoDB\Server\4.2\bin 
#mongo
#use webSensor      utilise la base
#db.createCollection("tweet")   pour créer une collection
#db.tweet.find()  pour afficher la collection (= table)


serveur = 'local' #'online'

if serveur == 'online':
    # MongoDB connection info
    hostname = 'mongodb-[projetagp].alwaysdata.net'
    port = 27017
    username = 'projetagp'
    password = 'projet2020'
    databaseName = 'projetagp_mongo'
else:
    hostname = 'localhost'
    port = 27017
    username = 'admin'
    password = 'admin'
    databaseName = 'webSensor'

client = MongoClient('mongodb://localhost:27017/')
db = client.webSensor

def saveInTweet(post):
    collection = db.tweet
    collection.insert_one(post)
    post.pop('_id', None)

def saveInCoronavirus(post):
    collection = db.coronavirus
    collection.insert_one(post)
    post.pop('_id', None)

def saveInExtrait(post):
    collection = db.extrait
    collection.insert_one(post)
    post.pop('_id', None)

def getLastTweetIdExtrait():
    collection = db.extrait
    tweet_id = ""
    for tweet in collection.find().sort([('tweet_id', 1)]).limit(1):
        tweet_id = tweet['tweet_id']
    return tweet_id

def getLastTweetId():
    #mongo command : db.collection.find().sort( { _id : -1 } ).limit(1);
    collection = db.coronavirus
    tweet_id = ""
    for tweet in collection.find().sort([('_id', -1)]).limit(1):
        print(tweet)
        tweet_id = tweet['tweet_id']
    return tweet_id


def selectAll():
    collection = db.tweet
    tweets = []
    #selection de 1000 tweets trier par tweet_id du plus récent au plus vieux .limit(3000)
    for tweet in collection.find().sort([('tweet_id', -1)]):
        #tweets.append(tweet)
        tweets.append(tweet['text'])
    return tweets

##Appel de test :
#tweets = selectAll()
#for tweet in tweets:
#    print(tweet)
