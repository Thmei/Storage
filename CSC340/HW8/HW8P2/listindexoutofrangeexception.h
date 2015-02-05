/*
Name: LinkedList_structNode_Exceptions.h
  Desc: declare two exception classes that are specific to List
  Copyright: 
  Author: 
Date: 11/10/14 22:49
  Modified: 11/19/2014
  Description: 
*/
#ifndef _LIST_EXCEPTIONS_H
#define _LIST_EXCEPTIONS_H

#include <stdexcept>
#include <string>

using namespace std;

class ListIndexOutOfRangeException : public out_of_range
{
public:
  
  /**/
  ListIndexOutOfRangeException(const string & message = "")
      : out_of_range(message.c_str())
  { }  // end constructor
  /**/
  //virtual const char* what() const throw()
  //{return "list: out of range";}
}; // end ListIndexOutOfRangeException



#endif
