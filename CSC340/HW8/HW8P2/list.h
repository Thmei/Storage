#ifndef LIST_H
#define LIST_H
 
#include "listexceptions.h"
#include "listindexoutofrangeexception.h"
#include <iostream>
 
typedef int ListItemType;
//typedef desired-type-of-list-item ListItemType;
 
/** @class List
  * ADT list - Pointer-based implementation. */
class List
{
    public:
    // Constructors and destructor:
 
    /** Default constructor. */
    List();
 
    /** Copy constructor.
      * @param aList The list to copy. */
    List(const List& aList);
 
    /** Destructor. */
    ~List();
 
    // List operations:
    bool isEmpty() const;
    int getLength() const;
    void insert(int index, const ListItemType& newItem)
        throw(ListIndexOutOfRangeException, ListException);
    void remove(int index)
        throw(ListIndexOutOfRangeException);
    void retrieve(int index, ListItemType& dataItem) const
        throw(ListIndexOutOfRangeException);
 
    // Overload = operator
    void operator=(const List& rhs);
 
    // Outputs lists
    friend ostream& operator<<(ostream& os, List& list);
 
    // Display list items in reverse order
    // If choice = 1, list is displayed in reverse
    // If choice = 2, list is flipped backwards
    void backwardsChoice(int choice);
    //void displaybackwards(ListNode *numList) const;
 
    // Insert new node to front of list
    void insert_front(const ListItemType& dataItem);
 
    private:
    /** A node on the list. */
    struct ListNode
    {
        /** A data item on the list. */
        ListItemType item;
        /** Pointer to next node. */
        ListNode *next;
    };  // end ListNode
 
    /** Number of items in list. */
    int size;
    /** Pointer to linked list of items. */
    ListNode *head;
 
    // Display the list backwards
    void displaybackwards(ListNode *ogList) const;
 
    // Reverse the order of the list
    void setbackwards(ListNode *initial, ListNode *current, ListNode *incri);
 
    /** Locates a specified node in a linked list.
      * @pre index is the number of the desired node.
      * @post None.
      * @param index The index of the node to locate.
      * @return A pointer to the index-th node. If index < 1
      *        or index > the number of nodes in the list,
      *        returns NULL. */
    ListNode *find(int index) const;
};  // end List
 
#endif 
