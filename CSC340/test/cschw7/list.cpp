/*
  Name:         list.cpp
  Assignment:   HW7
  Author:       Michael Yu
  SFSU ID:      myu@mail.sfsu.edu
  Compiler:     GNU GCC Compiler (should also work on g++)
*/

#include "list.h"

using namespace std;

List::List():size(0),head(NULL)
{
}

List::List(const List& aList) : size(aList.size)
{
    if(aList.head == NULL)
    {
        head = NULL;  // original list is empty
    }
    else
    {   // copy first node
        head = new ListNode;
        head->item = aList.head->item;
        // copy rest of list
        ListNode *newPtr = head;  // new list pointer
        // newPtr points to last node in new list
        // origPtr points to nodes in original list
        for(ListNode *origPtr = aList.head->next; origPtr != NULL; origPtr = origPtr->next)
        {
            newPtr->next = new ListNode;
            newPtr = newPtr->next;
            newPtr->item = origPtr->item;
        }   // end for
        newPtr->next = NULL;
    }   // end if
}   // end copy constructor

List::~List()
{
    while(!isEmpty())
    {
        remove(1);
    }
}  // end destructor

bool List::isEmpty() const
{
    return size == 0;
}   // end isEmpty

int List::getLength() const
{
    return size;
}   // end getLength

List::ListNode *List::find(int index) const
{
    if((index < 1) || (index > getLength()))
    {
        return NULL;
    }
    else  // count from the beginning of the list.
    {
        ListNode *cur = head;
        for(int skip = 1; skip < index; ++skip)
        {
            cur = cur->next;
        }
        return cur;
    }   // end if
}   // end find

void List::retrieve(int index, ListItemType& dataItem) const
    throw(ListIndexOutOfRangeException)
{
    if((index < 1) || (index > getLength()))
    {
        throw ListIndexOutOfRangeException("ListIndexOutOfRangeException: retrieve index out of range");
    }
    else
    {
        // get pointer to node, then data in node
        ListNode *cur = find(index);
        dataItem = cur->item;
    }   // end if
}   // end retrieve

void List::insert(int index, const ListItemType& newItem)
    throw(ListIndexOutOfRangeException, ListException)
{
    int newLength = getLength() + 1;
    if((index < 1) || (index > newLength))
    {
        throw ListIndexOutOfRangeException("ListIndexOutOfRangeException: insert index out of range");
    }
    else
    {   // try to create new node and place newItem in it
        try
        {
            ListNode *newPtr = new ListNode;
            size = newLength;
            newPtr->item = newItem;
            // attach new node to list
            if(index == 1)
            {   // insert new node at beginning of list
                newPtr->next = head;
                head = newPtr;
            }
            else
            {
                ListNode *prev = find(index - 1);
                // insert new node after node
                // to which prev points
                newPtr->next = prev->next;
                prev->next = newPtr;
            }   // end if
        }   // end try
        catch(bad_alloc e)
        {
            throw ListException("ListException: memory allocation failed on insert");
        }   // end catch
    }   // end if
}   // end insert

void List::remove(int index) throw(ListIndexOutOfRangeException)
{
    ListNode *cur;
    if((index < 1) || (index > getLength()))
    {
        throw ListIndexOutOfRangeException("ListIndexOutOfRangeException: remove index out of range");
    }
    else
    {
        --size;
        if(index == 1)
        {   // delete the first node from the list
            cur = head;  // save pointer to node
            head = head->next;
        }
        else
        {
            ListNode *prev = find(index - 1);
            // delete the node after the node to which prev points
            cur = prev->next;  // save pointer to node
            prev->next = cur->next;
        }   // end if
        // return node to system
        cur->next = NULL;
        delete cur;
        cur = NULL;
    }   // end if
}   // end remove

// Overloads the = operator
void List::operator=(const List& rhs)
{
    // Basically the copy constructor but size is changed
    size = rhs.size;
    if(rhs.head == NULL)
    {
        head = NULL;  // original list is empty
    }
    else
    {   // copy first node
        head = new ListNode;
        head->item = rhs.head->item;
        // copy rest of list
        ListNode *newPtr = head;  // new list pointer
        // newPtr points to last node in new list
        // origPtr points to nodes in original list
        for(ListNode *origPtr = rhs.head->next; origPtr != NULL; origPtr = origPtr->next)
        {
            newPtr->next = new ListNode;
            newPtr = newPtr->next;
            newPtr->item = origPtr->item;
        }   // end for
        newPtr->next = NULL;
    }   // end if
}

// Outputs lists
ostream& operator<<(ostream& os, List& list)
{
    for(List::ListNode *newPtr = list.head; newPtr != NULL; newPtr = newPtr->next)
    {
        os << newPtr->item << " ";
    }
    return os;
}

// Choose to display or modify backwards
void List::backwardsChoice(int choice)
{
    if(choice == 1)
    {
        displaybackwards(head);
    }
    else if(choice == 2)
    {
        ListNode *initial = head;
        ListNode *current = head;
        ListNode *incri = head->next;
        ListNode *last = head;

        while(last->next != NULL)
        {
            last = last->next;
        }
        head = last;
        setbackwards(initial, current, incri);
    }
}

// Display the list backwards
void List::displaybackwards(ListNode *ogList) const
{
    ListNode *newPtr = ogList;
    if(newPtr->next != NULL)
    {
        displaybackwards(newPtr->next);
    }
    cout << newPtr->item << " ";
}

// Insert new node to front of list
void List::insert_front(const ListItemType& dataItem)
{
    ListNode *newPtr = new ListNode;
    newPtr->next = head;
    head = newPtr;
    newPtr = NULL;
    head->item = dataItem;
    /*
     * Funny note...
     * insert(1, dataItem);
     * Calling this function fufills the assignment requirements
     * of creating a new node in the front of the list
     * I didn't use this in fear of being docked points
     */
}

// Reverse the order of the list
//void List::setbackwards()
void List::setbackwards(ListNode *initial, ListNode *current, ListNode *incri)
{
    if(incri->next != NULL)
    {
        setbackwards(initial, current->next, incri->next);
    }

    if(current == initial)
    {
        incri->next = current;
        current->next = NULL;
    }
    else
    {
        incri->next = current;
    }
}
