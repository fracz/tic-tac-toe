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
dtc.fit(moves['data'], moves['target'])

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

def searchForWinner(board):
    isThereADraw = 1.0
    for i in range(0, 9):
        isThereADraw *= board[i]
    if isThereADraw != 0.0:
        return 3.0

    for i in range(0, 3):
        vxs = 0;
        vos = 0;
        hxs = 0;
        hos = 0;
        for j in range(0, 3):
            if board[i * 3 + j] == 1.0:
                hxs += 1
            elif board[i * 3 + j] == 2.0:
                hos += 1
            if board[j * 3 + i] == 1.0:
                vxs += 1
            elif board[j * 3 + i] == 2.0:
                vos += 1
        if vxs == 3 or hxs == 3: 
            return 1.0
        elif vos == 3 or hos == 3:
            return 2.0

    crossScore = board[0] * board[4] * board[8]
    acrossScore = board[2] * board[4] * board[6]
    if crossScore == 1.0 or acrossScore == 1.0:
        return 1.0
    if crossScore == 8.0 or acrossScore == 8.0:
        return 2.0
    return 0.0
    
while True:
    el = sys.stdin.readline()
    if (len(board) <= int(el) or board[int(el)] != 0.0):
        print "Occupied! Try again"
        continue
    board[int(el)] = 2.0
    time.sleep(1)
    printBoard(board)
    if 2.0 == searchForWinner(board):
        print "You have won!"
        break
    elif 3.0 == searchForWinner(board):
        print "Draw!"
        break

    time.sleep(1)
    index = int(dtc.predict(board))
    if (len(board) <= index or board[index] != 0.0):
        print "I've figured out an impossible move, sorry!"
        break;
    board[index] = 1.0    
    if 1.0 == searchForWinner(board):
        print "You have lost!"
        break
    printBoard(board)

printBoard(board)
        

