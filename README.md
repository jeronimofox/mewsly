Mewsly

What is?

get news feed, parse the articles' text, analyze it with NLP-engine for entities - locations, cities, regions, states, countries, show map with tag notes with this places. 
News on the map.
What should be done here
News feed on cron refreshing and fetching into db

Elasticsearch will be better solution than mysql

CoreNLP and Web64\LaravelNlp for article parsing and entities extraction and classification.

Some Map API to add news notes' pins corenlp
there are 3 parts of server that I'm running on dev to use current functionality :
- corenlp
- nlpserver - python3 manage.py start
- and ELK
I think the best way is to connect it through docker-compose, but corenlp and nlpserver should be splitted at this moment. 
