/*
  Name:         listindexoutofrangeexception.h
  Assignment:   HW7
  Author:       Michael Yu
  SFSU ID:      myu@mail.sfsu.edu
  Compiler:     GNU GCC Compiler (should also work on g++)
*/

#ifndef LISTINDEXOUTOFRANGEEXCEPTION_H
#define LISTINDEXOUTOFRANGEEXCEPTION_H

#include <stdexcept>
#include <string>

using namespace std;

class ListIndexOutOfRangeException : public out_of_range
{
    public:
    ListIndexOutOfRangeException(const string & message = "") : out_of_range(message.c_str())
    {
    }  // end constructor
    //virtual const char* what() const throw()
    //{return "list: out of range";}
};  // end ListIndexOutOfRangeException

#endif // LISTINDEXOUTOFRANGEEXCEPTION_H
