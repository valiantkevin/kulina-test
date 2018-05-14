import math as m

batas = int(input())
batas = batas+1
bool_list=[True]*(batas)
bool_list[0]=False
bool_list[1]=False
for x in range(2,m.ceil(m.sqrt(batas))):
    i=2
    while(x*i<batas):
        bool_list[x*i]=False
        i=i+1
for y in range(batas):
    if (bool_list[y]):
        print(y)
