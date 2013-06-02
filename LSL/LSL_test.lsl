///
//
// This file is a test of how VirtualPersistAPI works from within
// Second Life. If you don't know what VPA is, then find out here:
// https://github.com/paul-m/VirtualPersistAPI

key gHttpRequestID;

// don't include slashes.
string gService = "http://vpa.pagodabox.com";
string gPrefix = "api";

integer gCurrentRequest = 0;
integer gStride = 4;

// to be filled by dataProvider().
list gTestData;

string getEndpoint() {
  list pathList = [gService, gPrefix];
  return llDumpList2String(pathList, "/");
}

// A big list of items for our test.
list dataProvider() {
  string endpoint = getEndpoint();
  string uuid = (string)llGetOwner();
  // strided list: URL, request type, data (to send), desired response.
  list data = [
    endpoint + "/" + uuid + "/cat/key", "GET", "", 200,
    endpoint + "/" + uuid + "/nonExistant/nonExistant", "GET", "", 404
  ];
  return data;
}

list currentTestData() {
  integer index = gCurrentRequest * gStride;
  if (index < llGetListLength(gTestData)) {
    return llList2List(gTestData, index, index + gStride);
  } else {
    llOwnerSay("done.");
    return [];
  }
}

sendRequest() {
  list testData = currentTestData();
  if (llGetListLength(testData) > 0) {
    string path = llList2String(testData, 0);
    llOwnerSay("Testing Path: " + path);
    gHttpRequestID = llHTTPRequest(
      path,
      [HTTP_METHOD, llList2String(testData, 1)], 
      llList2String(testData, 2)
    );
  }
}

default
{
  state_entry() {
    gTestData = dataProvider();
  }
  
    touch_start(integer foo) {
      gCurrentRequest = 0;
      sendRequest();
    }

    http_response(key request_id, integer status, list metadata, string body)
    {
  //    llOwnerSay((string)status + ": " + body);
        if (request_id == gHttpRequestID)
        {
          string message = "";
          list testData = currentTestData();
          integer response = llList2Integer(testData, 3);
//          llOwnerSay("expected: " + (string)response + " got: " + (string)status);
          if (status != response) {
            message += "PHAIL!: ";
          } else {
            message += "Passed: ";
          }
          message += llDumpList2String(testData, ", ");
          llOwnerSay(message);
          ++gCurrentRequest;
          sendRequest();
        }
    }
}
