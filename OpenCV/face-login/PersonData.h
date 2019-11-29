#ifndef PersonData_H
#define PersonData_H
#include <list>
#include <string>
#include <iostream>
using namespace std;

class PersonData {
    int id;
    string name;
    list<list<int>> data;
    public:
        PersonData() {}
        PersonData (int id, string name) {
            this->id = id;
            this->name = name;
        }

        void addToList(list<int> imgData);
        void printList();
        void printInfo();
        void addInfo(int id, string name);
};

void PersonData::addToList(list<int> imgData) {
    this->data.push_back(imgData);
}

void PersonData::addInfo(int id, string name) {
    this->id = id;
    this->name = name;
}

void PersonData::printInfo() {
    cout << "Id: " << this->id << endl;
    cout << "Name: " << this->name << endl;
}

void PersonData::printList() {
    list<list<int>>::iterator dataIter;
    
    for (dataIter = this->data.begin(); dataIter != this->data.end(); ++dataIter) {
        
        list<int>::iterator singleListIter; 
  
        list<int>& singleListPointer = *dataIter; 
  
        for (singleListIter = singleListPointer.begin(); singleListIter != singleListPointer.end(); singleListIter++) { 
            
            std::cout << " " << *singleListIter << " "; 
        }
        cout << "\n\n";
    }
}
#endif
