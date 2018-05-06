import MySQLdb
import sys

def insert():
    client = MySQLdb.connect(host="localhost", user="", passwd="", db="")
    cursor = client.cursor()
    sql = "SELECT url FROM link WHERE hash=\"" + sys.argv[1] + "\""
    client.query(sql)
    result=client.store_result()
    temp = result.fetch_row()[0][0]
    print temp
    client.close()
insert()
