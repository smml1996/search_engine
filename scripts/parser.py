import mysql.connector

urls = dict()
urls 
count = 0

print(f'program start: {0}')

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  #password="root",
  port="3306"
)


class WebPage:
    url = ''
    description =''
    links=[]
    def __init___(self):
        self.url = ''
        self.links = []
        self.description = ''

def write_edges(file_name, web_object):
    # print(len(web_object.links))
    ffrom = urls[web_object.url]
    file_name.write(f'\n\n{ffrom}')
    for url in web_object.links:
        to = urls[url]
        file_name.write(f'\n{to}')

def insert_db(web):
    mycursor = mydb.cursor()
    sql = "INSERT INTO duddle.webpage (url, description,title, realindex) VALUES (%s, %s, %s, %s)"
    val = (web.url,  web.description, web.description.split('\n')[0], urls[web.url])
    mycursor.execute(sql, val)
    mydb.commit()

def write_index(file_name, web):
    temp = web.description.split('\n')
    temp = '. '.join(temp)
    temp = web.description.split('\t')
    temp = ' '.join(temp)
    file_name.write(web.url+'\t'+temp+'\t'+temp.split(".")[0]+'\t'+str(urls[web.url])+'\n')
    
file = open("C:/Users/stefanie/Downloads/quotes_2009-04.txt", "r", encoding="utf-8")

index_file = open("C:/Users/stefanie/Downloads/index_file.txt", "w", encoding="utf-8")
index_file.write('url\tdescription\ttitle\trealindex\n')

arc_file = open("C:/Users/stefanie/Downloads/arc_file.txt", "w", encoding="utf-8")

webpage = WebPage()

# poni = 0
while True:
    line = file.readline()
    # print(line)
    if line == '':
        if len(webpage.url)> 0:
            # insert_db(webpage)
            write_index(index_file, webpage)
            write_edges(arc_file, webpage)
        break
    elif line == '\n':
        if len(webpage.url) > 0:
            # insert_db(webpage)
            write_index(index_file, webpage)
            write_edges(arc_file, webpage)
            # poni+=1
        webpage = WebPage()
        webpage.description = ''
        webpage.url = ''
        webpage.links = []
    else:
        tokens = line.split('\t')
        tokens[1] = tokens[1][:-1]
        if tokens[0] == 'P':
            webpage.url = tokens[1]
            if not tokens[1] in urls:
                urls[tokens[1]] = count
                count+=1
        elif tokens[0] == 'Q':
            if len(webpage.description) > 0:
                webpage.description+= '. '
            webpage.description+= tokens[1]
        elif tokens[0] == 'L':
            webpage.links.append(tokens[1])
            if not tokens[1] in urls:
                print(tokens[1])
                urls[tokens[1]] = count
                count+=1

file.close()
index_file.close()
arc_file.close()
