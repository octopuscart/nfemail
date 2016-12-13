# Function for find maximum possible permutations for a given list 
__author__ = "Pankaj Pathak"
__date__ = "$06 July, 2016 12:45:22 PM"

def recursion(element, elementlist):
    combination2 = lambda l:[l, l[::-1]]  #swapping of data
    if len(elementlist) == 2:
        if element in elementlist: #if element in list then return only combination 
            return combination2(elementlist)
        else:
            # Add element with combination
            return map(lambda e:[element]+e, combination2(elementlist))
    else:
        temp2 = []
        for i in elementlist:
            temp = elementlist[:]
            temp.remove(i)
            if len(temp)==2:
                 temp2 += recursion(i, temp) 
            else:
                #calling recursion while length of list  = 2 
                for j in recursion(i, temp): 
                    temp2.append([i]+j) #collecting combinations
        return temp2



def get_permutations(inputdata):
    return recursion(inputdata[0], inputdata)  



### Testing of function ####

inputdata = ['a', 'b', 'c', 'd']

#calculation factorial for possible permutations
fact = 1
for i in xrange(1, len(inputdata)+1):
    fact = fact * i
print "Possible permutations should be ",fact

## Official python tool for find permutations
import itertools
permutations = itertools.permutations(inputdata)
result1 =  (list(itertools.permutations(inputdata))) 

## Calling get_permutations function 
result2 =  get_permutations(inputdata) 

## Testing of each permutation
for i, j in enumerate(result1):
    print list(j), result2[i], list(j) == result2[i] and (i+1, "Ok")
    








