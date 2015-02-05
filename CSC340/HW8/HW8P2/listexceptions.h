#ifndef LISTEXCEPTIONS_H
#define LISTEXCEPTIONS_H
 
#include <stdexcept>
#include <string>
 
using namespace std;
 
class ListException : public logic_error
{
    public:
    ListException(const string & message = "") : logic_error(message.c_str())
    {
    }  // end constructor
    // virtual const char* what() const throw()
    //{return "list: logic error";}  //list is full
};  // end ListException
 
#endif
