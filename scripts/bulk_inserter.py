import pandas as pd
from sqlalchemy import create_engine

data = pd.read_csv("index_file.txt", sep='\t')

print(data.head())
'''
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  #password="root",
  port="3306"
)'''

engine = create_engine("mysql+pymysql://{user}@localhost/{db}"
                       .format(user="root",
                               db="duddle"))
data.to_sql('webpage', con = engine, if_exists = 'append', chunksize = 1000000,index=False)
