#include <iostream>
#include <cstdlib>
#include "list.h"

using namespace std;

list::list(){
			//ctr
}
list::~list(){
			//dctr
}
list::list(const list&){
	//cctr
}

		
void list::AddNode(int addData){
	nodePtr n = new node;
	n->next = NULL;
	n->data = addData;
	
	if(head!= NULL){
		curr = head;
		while(curr->next != NULL){
			curr = curr->next; 
		}
		curr->next = n;
	}else{
		head = n;
	}
}	

void list::DeleteNode(int delData){
	nodePtr delPtr = NULL;
	temp = head;
	curr = head;
	while(curr != NULL && curr->data !=delData){
		temp = curr;
		curr = curr->next;
			
	}
	if(curr == NULL){
		cout << delData << "Was not   found\n";
		delete delPtr;
		
	}
	else{
		delPtr = curr;
		curr = curr->next;
		temp->next = curr;
		
		if(delPtr == head){
			head = head->next;
			temp = NULL;	
		}
		
		delete delPtr;
		cout << delData << "Deleted!\n";
	}
}	

void list::PrintList(){
	curr = head;
	while(curr != NULL){
		cout << curr->data << "\n";
		curr = curr->next;
	}
	
}
