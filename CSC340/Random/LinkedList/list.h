#ifndef LIST_H
#define LIST_H



class list{
	public:
		
		typedef struct node{
			int data;
			node* next;
		}* nodePtr;
		
		nodePtr head = NULL;
		nodePtr curr = NULL;
		nodePtr temp = NULL;
		
		
		
		list();
		~list();
		list(const list&);
		
		
		void AddNode(int addData);
		void DeleteNode(int delData);
		void PrintList();
	
		
};

#endif
