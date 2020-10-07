import mysql.connector


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  #password="root",
  port="3306"
)
cur = mydb.cursor()
def get_values():
    values = []
    f = open('out_pagerank', 'r')
    lines = f.readlines()
    print(len(lines))
    return 0
    c=0
    p=0
    for line in lines:
        rank, ident = line.split('\t')
        ident = ident[:-1]
        values.append((rank, ident))
        c+=1
        if c % 1000 == 0:
            cur.executemany("UPDATE duddle.webpage SET pagerank = %s WHERE id = %s ", values)
            mydb.commit()
            values = []
            print('bulk insert', str(p))
            p+=1
            c=0
    if len(values) > 0:
        cur.executemany("UPDATE duddle.webpage SET pagerank = %s WHERE id = %s ", values)
        mydb.commit()
        
    

get_values()



