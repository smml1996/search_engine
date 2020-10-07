import mysql.connector

    
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  #password="root",
  port="3306"
)
cur = mydb.cursor()
f = open("output_inverted")

lines = f.readlines()

temp_words = []
c=0
ident = 1
links = []
for line in lines:
    tokens = line.split('\t')

    temp_words.append((ident,tokens[0]))
    tokens[1] = tokens[1][:-1]
    links.append(tokens[1])
    ident+=1
    c+=1
    if c % 10000== 0:
        #print(temp_words)
        # cur.executemany(" INSERT INTO duddle.words ( id,word ) VALUES ( %s,%s ) ", temp_words)
        mydb.commit()
        temp_words = []
        print('bulk insert')
        c=0
if len(temp_words) > 0:
    pass
    #cur.executemany("INSERT INTO duddle.words ( id,word ) VALUES ( %s,%s ) ", temp_words)
    #mydb.commit()

temp_words = []
print("PALABRAS INSERTADAS")

temp = []
c = 0
for i in range(0, len(links)):
    tokens = links[i].split(' ')
    for j in range(1, len(tokens)):
        wf = tokens[j].split(':')
        temp.append((i+1, wf[0], wf[1]))
        c+=1
        if c % 10000 == 0:
        #print(temp_words)
            cur.executemany(" INSERT INTO duddle.searcher ( word_id, webpage_id, occurences ) VALUES ( %s,%s,%s ) ", temp)
            mydb.commit()
            temp= []
            print('bulk insert2')
            c=0
if len(temp) > 0:
    cur.executemany("INSERT INTO duddle.searcher ( word_id, webpage_id, occurences ) VALUES ( %s,%s,%s ) ", temp)
    mydb.commit()
        
        
    
