import MySQLdb
import sys
from hashids import Hashids

hashids = Hashids()

def insert():

    client = MySQLdb.connect(host="localhost", user="", passwd="", db="")
    cursor = client.cursor()
    sql = "SELECT id FROM id WHERE used=0"
    client.query(sql)
    result=client.store_result()
    temp = result.fetch_row()[0][0]
    print hashids.encode(int(temp), int(temp))
    cursor.execute ("UPDATE id SET used=1 WHERE used=0")
    client.commit()
    query = "INSERT INTO id(id) values(\"" + str(int(temp) + 1) + "\")"
    cursor = client.cursor()
    cursor.execute(query)
    client.commit()
    client.close()
insert()
