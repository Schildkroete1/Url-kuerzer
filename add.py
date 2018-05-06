import MySQLdb
import sys

def insert():
    client = MySQLdb.connect(host="localhost", user="", passwd="", db="")
    try:
        cursor = client.cursor()
        query = "INSERT INTO link(hash, url) values(\"" + sys.argv[1] +"\", \"" + sys.argv[2] + "\")"
        cursor.execute(query)
        client.commit()
    except Exception:
        print Exception
        client.rollback()
    finally:
        client.close()
insert()
