#ifndef DataHolder_H
#define DataHolder_H
#include "PersonData.h"
#include <list>
#include <vector>
using namespace std;

class DataHolder {
    int rootSize;
    vector<PersonData> holder;
    public:
        DataHolder(){}
        DataHolder(int size) {
            this->rootSize = size;
        }

        void printList();
        void addToHolder(PersonData person);
        void compareData(vector<int> dataPoints, vector<int>& topThree);
};

void DataHolder::addToHolder(PersonData person) {
    this->holder.push_back(person);
}

void DataHolder::printList() {

    for (int i = 0; i < this->holder.size(); i++) {
        cout << "ID: " << holder[i].getId() << " ";
        cout << "Name: " << holder[i].getName() << endl;
        cout << "List:  \n";
        vector<vector<int> > dataSet = holder[i].getList();
        int listCounter = 0;
        for (int j = 0; j < dataSet.size(); j++) {
            listCounter++;
            cout << "set " << listCounter << "\n";
            for (int k = 0; k < dataSet[i].size(); k++)
                std::cout << " " << dataSet[i][j] << " ";
        }

    }
}
//Data Points are Passed in Scanned Image
void DataHolder::compareData(vector<int> dataPoints, vector<int>& topThree) {
    int threshold = 7;  string a, b, c; int ida, idb, idc;
    int mina = 0; int minb = 0; int minc = 0;
    int outerCounter = 0;
    //Loop through DataHolder
    for (int i = 0; i < this->holder.size(); ++i) {
        int currentID = holder[i].getId();
        string currentName = holder[i].getName();
        //cout << "ID: " << currentID << " ";
        //cout << "Name: " << currentName << endl;
        // cout << "List:  \n";
        vector<vector<int> > dataSet = holder[i].getList();
        int listCounter = 0; int totalHits = 0; 
        //Loop through DataSets per Holder Element
        for (int j = 0; j < dataSet.size(); ++j) {
            listCounter++;
            //cout << "set " << listCounter << "\n";
            //SINGLE (will make multiple sets eventually)
            int index = 0;
            for (int k = 0; k < dataSet[j].size(); k++) {
                if (abs(dataSet[j][k] - dataPoints[i]) <= threshold) {
                    totalHits++;
                    index++;
                }
                    
            }

            //cout << "\n\n";
        }
        outerCounter++;
        // cout << "List counter " << outerCounter << endl;
        // cout << "totl hits: " << currentName << " " << totalHits << endl;
        // cout << "Current Min A B C: " << mina << " " << minb << " " << minc << " \n" << endl;
        
        if (totalHits >= mina) { //first place
        //cout << "A section " << currentID << endl;
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