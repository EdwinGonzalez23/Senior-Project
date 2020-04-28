#ifndef PersonData_H
#define PersonData_H
#include <list>
#include <string>
#include <iostream>
#include <vector>
using namespace std;

class PersonData {
    int id;
    string name;
    vector<vector<int>> data;
    public:
        PersonData() {}
        PersonData (int id, string name) {
            this->id = id;
            this->name = name;
        }

        void addToList(vector<int> imgData);
        int getId() {return this->id;}
        string getName() {return this->name;}
        vector<vector<int>> getList() {return this->data;}
        void printList();
        void printInfo();
        void addInfo(int id, string name);
};

void PersonData::addToList(vector<int> imgData) {
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

    for (int i = 0; i < this->data.size(); i++) {
        for (int j = 0; j < this->data[i].size(); j++)
            cout << " " << data[i][j] << " ";
    }
    cout << "\n" << endl;
    
}
#endif
