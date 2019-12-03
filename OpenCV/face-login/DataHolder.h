#ifndef DataHolder_H
#define DataHolder_H
#include "PersonData.h"
#include <list>
using namespace std;

class DataHolder {
    int rootSize;
    list<PersonData> holder;
    public:
        DataHolder(){}
        DataHolder(int size) {
            this->rootSize = size;
        }

        void printList();
        void addToHolder(PersonData person);
        void compareData(list<int> dataPoints, vector<int>& topThree);
};

void DataHolder::addToHolder(PersonData person) {
    this->holder.push_back(person);
}

void DataHolder::printList() {
    list<PersonData>::iterator dataIter;
    for (dataIter = this->holder.begin(); dataIter != this->holder.end(); ++dataIter) {
        cout << "ID: " << dataIter->getId() << " ";
        cout << "Name: " << dataIter->getName() << endl;
        cout << "List:  \n";
        list<list<int>> pData = dataIter->getList();
        list<list<int>>::iterator personDataIter;
        int listCounter = 0;
        for (personDataIter = pData.begin(); personDataIter != pData.end(); ++personDataIter) {
            listCounter++;
            cout << "set " << listCounter << "\n";
            list<int>::iterator singleListIter; 
            list<int>& singleListPointer = *personDataIter; 
            for (singleListIter = singleListPointer.begin(); singleListIter != singleListPointer.end(); singleListIter++) { 
                
                std::cout << " " << *singleListIter << " "; 
            }
            cout << "\n\n";
        }   
    }
}

void DataHolder::compareData(list<int> dataPoints, vector<int>& topThree) {
    int threshold = 7;  string a, b, c; int ida, idb, idc;
    int mina = 0; int minb = 0; int minc = 0;
    list<PersonData>::iterator dataIter;
    list<int>::iterator dataPointIter;int outerCounter = 0;
    for (dataIter = this->holder.begin(); dataIter != this->holder.end(); ++dataIter) {
        int currentID = dataIter->getId();
        string currentName = dataIter->getName();
         cout << "ID: " << currentID << " ";
        cout << "Name: " << dataIter->getName() << endl;
        // cout << "List:  \n";
        list<list<int>> pData = dataIter->getList();
        list<list<int>>::iterator personDataIter;
        list<int>::iterator testDatIter;
        int listCounter = 0; int totalHits = 0; 
        for (personDataIter = pData.begin(); personDataIter != pData.end(); ++personDataIter) {
            listCounter++;
            //cout << "set " << listCounter << "\n";
            list<int>::iterator singleListIter; 
            list<int>& singleListPointer = *personDataIter; 
            
            for (singleListIter = singleListPointer.begin(), dataPointIter = dataPoints.begin(); singleListIter != singleListPointer.end() && dataPointIter != dataPoints.end(); singleListIter++, dataPointIter++) { 
                
                //std::cout << " " << *singleListIter << " "; 
                //cout << " " << *dataPointIter << " ";
                if (abs(*singleListIter - *dataPointIter) <= threshold) {
                    //cout << "Data Point Match " << *singleListIter << " - " << *dataPointIter << endl;
                    totalHits++;
                }
            }
            //cout << "\n\n";
        }
        outerCounter++;
        cout << "List counter " << outerCounter << endl;
        cout << "totl hits: " << dataIter->getName() << " " << totalHits << endl;
        cout << "Current Min A B C: " << mina << " " << minb << " " << minc << " \n" << endl;
        
        if (totalHits >= mina) { //first place
        cout << "A section " << currentID << endl;
            if (a.empty()) {
                mina = totalHits;
                ida = currentID;
                a = currentName;
                topThree[0] = currentID;
            } else if (!a.empty() && b.empty()) {
                minb = totalHits;
                idb = currentID;
                b = currentName;
                topThree[1] = currentID;
            } else if (!a.empty() && !b.empty() && c.empty()) {
                minc = totalHits;
                idc = currentID;
                c = currentName;
                topThree[2] = currentID;
            } 
        } else if (totalHits < mina && totalHits >= minb) { //2nd place
        cout << "B section " << currentID << endl;
            if (b.empty()) {
                minb = totalHits;
                idb = currentID;
                b = currentName;
                topThree[1] = currentID;
            } else if (!b.empty() && c.empty()) {
                minc = totalHits;
                idc = currentID;
                c = currentName;
                topThree[2] = currentID;
            }
        } else if (totalHits < minb && totalHits >= minc) {
            cout << "A section " << currentID << endl;
            if (c.empty()) {
                minc = totalHits;
                idc = currentID;
                c = currentName;
                topThree[2] = currentID;
            }
        } else {
            cout << "Nothing " << endl;
        }
        
        
    }
    cout << "\n\nTop Person: " << a << endl;
    cout << "Second Person: " << b << endl;
    cout << "Third Person: " << c << endl;
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