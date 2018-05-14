n = str(input())
for x in range(len(n)):
    print(n[x]+("0"*(len(n)-x-1)))
