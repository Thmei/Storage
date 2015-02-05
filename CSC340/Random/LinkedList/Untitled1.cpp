#include <iostream>

using namespace std;

struct node {
	int data;
	node* next;
	
};

int main(){
	//linked list
node* n;
node* t;
node* h;	
n = new node;
n->data = 1;
t = n;
h = n;

n = new node;
n->data = 3;

t->next = n;
t = t->next;


cout << n << endl;
cout << t << endl;
cout << h << endl; // address
cout << &n << endl;
cout << n->data << endl;
cout << t->next << endl;	
	
	
	return 0;
}
