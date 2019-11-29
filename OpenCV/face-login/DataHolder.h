#ifndef DataHolder_H
#define DataHolder_H
#include "PersonData.h"
using namespace std;

#include <list>
class DataHolder {
    int rootSize;
    list<PersonData> holder;
    public:
        DataHolder(int size) {
            this->rootSize = size;
        }

        void printList(int rootSize);
        void addToHolder(PersonData person);
};

void DataHolder::addToHolder(PersonData person) {
    this->holder.push_back(person);
}

void DataHolder::printList(int size) {
    for (list<PersonData>::iterator dataIter = this->holder.begin(); dataIter != this->holder.end(); ++dataIter) {
        
        //list<int>::iterator singleListIter; 
        //list<int>& singleListPointer = *dataIter; 
        cout << dataIter.name << endl;
        // for (singleListIter = singleListPointer.begin(); singleListIter != singleListPointer.end(); singleListIter++) { 
            
        //     std::cout << " " << *singleListIter << " "; 
        // }
        // cout << "\n\n";
    }
    
}

#endif

/* NOTES
    Chain Hash to List 
    Example 
    First Level [0,1,2,3,4,5]
    Choose 0 -> [0,1,2,3,4]
    choose [0][0]

    0---------->[0 1 2 3 4]
                Sub Level
                [0 1 2 3 4]
                [0 1 2 3 4]
*/