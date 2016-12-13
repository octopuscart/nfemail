cstr  = ['27','7','14', '24']
for c1 in cstr:
    cstrt = cstr[:]
    cstrt.remove(c1)
    print c1, cstrt

for c1 in xrange(len(cstr)*2):
    cstrt = cstr[:]
    print c1
    #ele = cstrt[c1]
    #cstrt.remove(ele)
    #print ele, cstrt
print "----------"
fact = 1

cstr = ['27', '7']

llist = len(cstr)

for i in xrange(1, llist+1):
    fact = fact * i

mrange = fact/llist
for i in xrange(fact):
    
    for j in xrange(llist):
        print j,
    print "\n"
