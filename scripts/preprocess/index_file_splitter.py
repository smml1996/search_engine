import pandas as pd

data = pd.read_csv("index_file.txt", sep='\t')

# drop by Name
data = data.drop(['url', 'title'], axis=1)

count_row = data.shape[0]

half = int(count_row/2)
df1 = data.iloc[:half]
df1.to_csv ('df1.csv', index = False, header=True, sep='\t')
df2 = data.iloc[half:]
df2.to_csv ('df2.csv', index = False, header=True, sep='\t')



