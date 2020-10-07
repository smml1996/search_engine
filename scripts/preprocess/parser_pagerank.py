
class Webpage:
    links = []
    ident = -1

    def __init__(self):
        self.links = []
        self.ident = -1

webpages = []

def read_file(file):
    f = open(file, "r")

    lines = f.readlines()
    is_new = True
    webpage = Webpage()
    webpage.ident = -1
    for line in lines:
        if line == '\n':
            is_new = True
            if webpage.ident != -1:
                webpages.append(webpage)
            webpage = Webpage()
            webpage.ident = -1
            webpage.links = []
        else:
            line = line[:-1]
            # print(len(line))
            if is_new:
                webpage.ident = line
                is_new = False
            else:
                webpage.links.append(line)
    f.close()

read_file("arc_file.txt")
read_file("arc_file2.txt")


# print(webpages[:5])

f = open('pagerank_format.txt', 'w')

# initial_page_rank = 1/len(webpages)
for w in webpages:
    for l in w.links:
        f.write(w.ident + '\t' + l + '\n')

f.close()




    
