# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class PapercrawlerItem(scrapy.Item):
    journal = scrapy.Field()
    title = scrapy.Field()
    keywords = scrapy.Field()
    place = scrapy.Field()
    available_date = scrapy.Field()
    journal_date = scrapy.Field()
    authors = scrapy.Field()
    affiliations = scrapy.Field()