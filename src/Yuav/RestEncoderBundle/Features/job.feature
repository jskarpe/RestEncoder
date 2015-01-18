Feature: Ensure that create, read, update and delete (CRUD) works for jobs

    Scenario: Testing headers
        When I send a GET request to "api/v1/jobs"
        Then the header "Content-Type" should contain "text"
        And the header "Content-Type" should be equal to "text/html; charset=utf-8"
        And the header "Content-Type" should not contain "text/json"
        And the header "xxx" should not exist
        And the response should be encoded in "UTF-8"
        #And the response should expire in the future

        When I send a GET request to "api/v1/jobs.json"
        Then the header "Content-Type" should contain "application/json"
        
#        When I add "Accept" header equal to "application/json"
#        And I send a GET request to "api/v1/jobs"
#        Then the header "Content-Type" should contain "application/json" 
        
        When I send a GET request to "api/v1/jobs.xml"
        Then the header "Content-Type" should contain "text/xml"

    Scenario: Testing request methods.
        Given There is no "Job" in database
        And I have a job with input "http://testfile.mp4"
        
        When I send a GET request to "api/v1/jobs.json"
        Then the response should be in JSON
        And the JSON node "root" should exist
        And the JSON node "root[0].input.uri" should contain "http://testfile.mp4"

        When I send a "POST" request to "api/v1/jobs.json" with JSON body:
            """
            {"input":"http://testfile2.mp4"}
            """
        Then the response should be empty
        And the response status code should be 201
        And the header "Location" should contain "api/v1/jobs/2.json"
        When I send a GET request to "api/v1/jobs/2.json"
        Then the response should be in JSON

        And the JSON response should contain:
            """
            {
                "id": 2,
                "input": {
                	"uri": "http:\/\/testfile2.mp4"
                }
            }
            """        

        When I send a DELETE request to "api/v1/jobs/2.json" with JSON body:
	        """
	        """
        Then print response body 
        Then the response should be empty
        And the response status code should be 204
        When I send a GET request to "api/v1/jobs/2.json"
        Then the response status code should be 404
        
    Scenario: Testing Job progress.
        Given There is no "Job" in database
        And I have a job with progress "30"
        When I send a GET request to "api/v1/jobs/1/progress.json"
        Then the response should be in JSON
        And the JSON response should contain:
            """
            {
			  "state": "encoding",
			  "input": {
			    "current_event": "Queued"
			  },
			  "outputs": [
			    {
			      "current_event": "Transcoding"
			    },
			    {
			      "current_event": "Uploading"
			    }
			  ]
			}
            """
        
