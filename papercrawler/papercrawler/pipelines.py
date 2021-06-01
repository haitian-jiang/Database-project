import time
import pymysql
from itemadapter import ItemAdapter


class PapercrawlerPipeline:
    db = pymysql.connect(host='101.94.138.133', user='root', passwd='MyPasswd', db='paper', charset='utf8')
    cursor = db.cursor()

    def process_item(self, item, spider):
        journal = item.get("journal")
        title = item.get("title")
        keywords = item.get("keywords")
        place = item.get("place")
        available_date = item.get("available_date")
        available_date = time.strftime("%Y-%m-%d %H:%M:%S", item.get("available_date"))
        journal_date = time.strftime("%Y-%m-%d %H:%M:%S", item.get("journal_date"))
        authors = item.get("authors")
        affiliations = item.get("affiliations")

        paper_insert_sql = f"INSERT INTO paper(name, available_date, jname, jtime, jplace) \
                             VALUES('{title}', '{available_date}', '{journal}', '{journal_date}', '{place}')"
        try:
            self.cursor.execute(paper_insert_sql)
            self.db.commit()
        except:
            self.db.rollback()
        
        paper_id_sql = f"SELECT id FROM paper WHERE name='{title}'"
        self.cursor.execute(paper_id_sql)
        paper_id = self.cursor.fetchone()[0]

        if keywords:
            for keyword in keywords:
                kw_sql = f"INSERT INTO keyword(pid, keyword) \
                           VALUES({paper_id}, '{keyword}')"
                try:
                    self.cursor.execute(kw_sql)
                    self.db.commit()
                except:
                    self.db.rollback()

        for author, aff_list in authors.items():
            if aff_list == []:
                aff_list.append("none")
            for aff_id in aff_list:
                affiliation = affiliations[aff_id]
                author_sql = f"INSERT INTO author(pid, name, institution) \
                               VALUES({paper_id}, '{author}', '{affiliation}')"
                try:
                    self.cursor.execute(author_sql)
                    self.db.commit()
                except:
                    self.db.rollback()