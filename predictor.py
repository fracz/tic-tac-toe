import sys, time
from numpy import recfromcsv
from sklearn.tree import DecisionTreeClassifier
from sklearn.preprocessing import OneHotEncoder

csvData = recfromcsv('data/data.txt', delimiter=',')

moves = {
    'data': [],
    'target': []
}

def convert(state):
    if state == '_':
        return 0.
    elif state == 'x':
        return 1.
    elif state == 'o':
        return 2.
    return float(state)

for entry in csvData:
    row = []
    row.extend(entry)
    nextData = row[:-1]
    nextTarget = row[-1]
    moves['data'].append(map(convert, nextData))
    moves['target'].append(convert(nextTarget))

dtc = DecisionTreeClassifier()
dtc.fit(moves['data'][:-1], moves['target'][:-1])

board = [0., 0., 0., 0., 0., 0., 0., 0., 0.]

def printBoard(board):
    index = 1
    for el in board:
        if el < 0.1:
            print ' ',
        elif el == 1.0:
            print 'x',
        elif el == 2.0:
            print 'o',
        else:
            print el
        print '|',
        if index % 3 == 0:
            print '\n',
        index += 1
    
while True:
    el = sys.stdin.readline()
    if (len(board) <= int(el) or board[int(el)] != 0.0):
        print "Occupied! Try again"
        continue
    board[int(el)] = 2.0
    time.sleep(1)
    printBoard(board)
    time.sleep(1)
    index = int(dtc.predict(board))
    if (len(board) <= index or board[index] != 0.0):
        print "I've figured out an impossible move, sorry!"
        break;
    board[index] = 1.0
    printBoard(board)

printBoard(board)
        

