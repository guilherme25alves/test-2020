---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Admin Students API

See all information about each endpoint API 

<!-- END_INFO -->

#Courses


APIs for managing courses
<!-- START_ef32e47da1d827fbd167c1b94f584c6a -->
## get()

Get list of all Courses created

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "course_id": 4,
            "title": "Biology",
            "description": "Lessons on the behavior of marine animals",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```

### HTTP Request
`GET api/v1/courses`


<!-- END_ef32e47da1d827fbd167c1b94f584c6a -->

<!-- START_53439ed9242096bbad4fcef596e79a31 -->
## getById($id)

Get specified Course by course_id idenitifier

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/courses/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [course_id]"
}
```
> Example response (200):

```json
{
    "data": {
        "course_id": 1,
        "title": "Biologia",
        "description": "Molestiae ab repellat ea consectetur.",
        "created_at": "2020-07-25T00:05:20.000000Z",
        "updated_at": "2020-07-25T00:05:20.000000Z"
    },
    "message": "Retrieved successfully"
}
```

### HTTP Request
`GET api/v1/courses/{course_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `course_id` |  required  | The ID of course..

<!-- END_53439ed9242096bbad4fcef596e79a31 -->

<!-- START_357446793f74927501927847f5b2e037 -->
## getEnrollmentsByCourse($courseId)

Get list of Enrollments for specified Course, identifier by ID course

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/courses/enrollments/9" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses/enrollments/9"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "enrollment_id": 3,
        "student_id": 31,
        "course_id": 2,
        "enrollment_date": "2020-07-25 00:05:20",
        "created_at": "2020-07-25T00:05:20.000000Z",
        "updated_at": "2020-07-25T00:05:20.000000Z"
    }
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [course_id]"
}
```

### HTTP Request
`GET api/v1/courses/enrollments/{course_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `course_id` |  required  | The ID of course.

<!-- END_357446793f74927501927847f5b2e037 -->

<!-- START_7eeda31f899cc98225ea27054b5309a6 -->
## getByTitle($title)

Get specified Course by title field

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/courses/title/&quot;Biology&quot;" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses/title/&quot;Biology&quot;"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "course_id": 4,
            "title": "Biology",
            "description": "Lessons on the behavior of marine animals",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [title]"
}
```

### HTTP Request
`GET api/v1/courses/title/{title}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `title` |  required  | The Title of course..

<!-- END_7eeda31f899cc98225ea27054b5309a6 -->

<!-- START_15245ea1278895ac4c88a2967d66b62d -->
## store(Request $request)

Register a new Course in database

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/courses" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"\"Algorithm Classes\"","description":"\"Lessons to learn about POO\""}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "\"Algorithm Classes\"",
    "description": "\"Lessons to learn about POO\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "message": "Created successfully"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": {
        "title": [
            "The title field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/courses`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The title of the course.
        `description` | string |  optional  | The description of the course.
    
<!-- END_15245ea1278895ac4c88a2967d66b62d -->

<!-- START_13ffb7299846115ee5319d2f5de0fd2b -->
## update(Request $request, $id)

Update an existing Course

 Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/courses/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"\"Algorithm Classes\"","description":"\"Lessons to learn about POO\""}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "\"Algorithm Classes\"",
    "description": "\"Lessons to learn about POO\""
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Retrieved successfully"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`PUT api/v1/courses/{course_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `course_id` |  required  | The ID of the course.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The title of the course.
        `description` | string |  optional  | The description of the course.
    
<!-- END_13ffb7299846115ee5319d2f5de0fd2b -->

<!-- START_58e93b7a06ebc838404983ad7dbfb465 -->
## delete($id)

Delete an existing Course

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/courses/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/courses/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Deleted successfully"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`DELETE api/v1/courses/{course_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `course_id` |  required  | The ID of the course.

<!-- END_58e93b7a06ebc838404983ad7dbfb465 -->

#Enrollments


APIs for managing enrollments
<!-- START_4323705648a4451527c547c7f4ca333d -->
## get()

Get list of all Enrollments created

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/enrollments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/enrollments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "enrollment_id": 3,
            "student_id": 31,
            "course_id": 2,
            "enrollment_date": "2020-07-25 00:05:20",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```

### HTTP Request
`GET api/v1/enrollments`


<!-- END_4323705648a4451527c547c7f4ca333d -->

<!-- START_822c2c51cd4a9f235f67095e3a46d937 -->
## getById($id)

Get specified Enrollment by enrollment_id idenitifier

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/enrollments/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/enrollments/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "enrollment_id": 3,
        "student_id": 31,
        "course_id": 2,
        "enrollment_date": "2020-07-25 00:05:20",
        "created_at": "2020-07-25T00:05:20.000000Z",
        "updated_at": "2020-07-25T00:05:20.000000Z"
    }
}
```

### HTTP Request
`GET api/v1/enrollments/{enrollment_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `enrollment_id` |  required  | The ID of enrollment..

<!-- END_822c2c51cd4a9f235f67095e3a46d937 -->

<!-- START_200b3b18f46015eaf486e02bb891b25d -->
## store(Request $request)

Register a new Enrollment in database

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/enrollments" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"student_id":20,"course_id":5}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/enrollments"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "student_id": 20,
    "course_id": 5
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "message": "Created successfully"
}
```
> Example response (302):

```json
{
    "message": "This course and student information already exists in an existing enrollment!"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": {
        "student": [
            "The student field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/enrollments`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `student_id` | integer |  required  | The student identifier.
        `course_id` | integer |  required  | The course identifier.
    
<!-- END_200b3b18f46015eaf486e02bb891b25d -->

<!-- START_ae991ee600b55b63e4eb757106e9f62e -->
## update(Request $request, $id)

Update an existing Enrollment

 Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/enrollments/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"student_id":20,"course_id":5}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/enrollments/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "student_id": 20,
    "course_id": 5
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Retrieved successfully"
}
```
> Example response (302):

```json
{
    "message": "This course and student information already exists in an existing enrollment!"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`PUT api/v1/enrollments/{enrollment_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `enrollment_id` |  required  | The ID of the enrollment.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `student_id` | integer |  required  | The student identifier.
        `course_id` | integer |  required  | The course identifier.
    
<!-- END_ae991ee600b55b63e4eb757106e9f62e -->

<!-- START_b3b447e47b1bddc11831cd3eac2fb153 -->
## delete($id)

Delete an existing Enrollment

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/enrollments/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/enrollments/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Deleted successfully"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`DELETE api/v1/enrollments/{enrollment_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `enrollment_id` |  required  | The ID of the enrollment.

<!-- END_b3b447e47b1bddc11831cd3eac2fb153 -->

#Students


APIs for managing students
<!-- START_d3a7ef4332049d77a813a7f08870cbcd -->
## get()

Get list of all Students created

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "student_id": 1,
            "name": "Dr. Kendra Carroll",
            "email": "kris45@.org",
            "birthdate": "1991-03-10",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        },
        {
            "student_id": 2,
            "name": "Mitchel Cartwright",
            "email": "abigale61@.net",
            "birthdate": "1978-04-22",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```

### HTTP Request
`GET api/v1/students`


<!-- END_d3a7ef4332049d77a813a7f08870cbcd -->

<!-- START_d87679b1483f5e7d68622a2cbeae51eb -->
## getById($id)

Get specified Student by student_id idenitifier

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected"
}
```
> Example response (200):

```json
{
    "data": {
        "student_id": 1,
        "name": "Dr. Kendra Carroll",
        "email": "kris45@example.org",
        "birthdate": "1991-03-10",
        "created_at": "2020-07-25T00:05:20.000000Z",
        "updated_at": "2020-07-25T00:05:20.000000Z"
    },
    "message": "Retrieved successfully"
}
```

### HTTP Request
`GET api/v1/students/{student_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `student_id` |  required  | The ID of student.

<!-- END_d87679b1483f5e7d68622a2cbeae51eb -->

<!-- START_54db1eb0bb4533f7eb3f704efc42a7b6 -->
## getByTextField($textValue)

Get list of Students by text sent to search for email or name

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students/search-text/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/search-text/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [textValue]"
}
```
> Example response (200):

```json
{
    "data": [
        {
            "student_id": 2,
            "name": "Mitchel Cartwright",
            "email": "abigale61@example.net",
            "birthdate": "1978-04-22",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ],
    "message": "Retrieved successfully"
}
```

### HTTP Request
`GET api/v1/students/search-text/{text}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `textfield` |  required  | The part of field searched (name or e-mail)..

<!-- END_54db1eb0bb4533f7eb3f704efc42a7b6 -->

<!-- START_24995a5a6b0a997a3bbbf30a4b81b4b5 -->
## getByName($name)

Get Students by part of name searched

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students/name/&quot;Dr. or Kendra Carroll&quot;" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/name/&quot;Dr. or Kendra Carroll&quot;"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "student_id": 1,
            "name": "Dr. Kendra Carroll",
            "email": "kris45@example.org",
            "birthdate": "1991-03-10",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```
> Example response (404):

```json
{
    "message": "Resource not found "
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [name]"
}
```

### HTTP Request
`GET api/v1/students/name/{name}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `name` |  required  | The Name or part of name of Students..

<!-- END_24995a5a6b0a997a3bbbf30a4b81b4b5 -->

<!-- START_8da1defb74fb5cd4d4327734b1dfad36 -->
## getEnrollmentsByStudent($studentId)

Get list of Enrollments for specified Student, identifier by ID student

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students/enrollments/9" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/enrollments/9"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "enrollment_id": 3,
            "student_id": 2,
            "enrollment_date": "2020-07-25 00:05:20",
            "created_at": "2020-07-25T00:05:20.000000Z",
            "updated_at": "2020-07-25T00:05:20.000000Z"
        }
    ]
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [student_id]"
}
```

### HTTP Request
`GET api/v1/students/enrollments/{student_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `student_id` |  required  | The ID of Student.

<!-- END_8da1defb74fb5cd4d4327734b1dfad36 -->

<!-- START_392a85055a3e1a689fe84661c2f010ae -->
## getByEmail($email)

Get specified Student by email field

> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/students/email/&quot;kris45@example.org&quot;" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/email/&quot;kris45@example.org&quot;"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": {
        "student_id": 1,
        "name": "Dr. Kendra Carroll",
        "email": "kris45@example.org",
        "birthdate": "1991-03-10",
        "created_at": "2020-07-25T00:05:20.000000Z",
        "updated_at": "2020-07-25T00:05:20.000000Z"
    }
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```
> Example response (400):

```json
{
    "message": "Null parameter detected [email]"
}
```

### HTTP Request
`GET api/v1/students/email/{email}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `email` |  required  | The complete Email of Student..

<!-- END_392a85055a3e1a689fe84661c2f010ae -->

<!-- START_30323be2228388586968760b6f0f4fb0 -->
## store(Request $request)

Register a new Student in database

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/students" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"\"Abigail\"","email":"abigale61@example.net\"","birthdate":"1978-04-22\""}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/students"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "\"Abigail\"",
    "email": "abigale61@example.net\"",
    "birthdate": "1978-04-22\""
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "message": "Created successfully"
}
```
> Example response (422):

```json
{
    "message": "The given data was invalid",
    "errors": {
        "name": [
            "The name field is required."
        ]
    }
}
```

### HTTP Request
`POST api/v1/students`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The name of the student.
        `email` | string |  required  | The email of the student.
        `birthdate` | date |  optional  | Student's date of birth.
    
<!-- END_30323be2228388586968760b6f0f4fb0 -->

<!-- START_03e5de6d49d6faa8e56d64a8cb961e05 -->
## update(Request $request, $id)

Update an existing Student
 Detail: In case the request is incomplete, the API assumes the old values ​​and only changes what is inserted again

> Example request:

```bash
curl -X PUT \
    "http://localhost/api/v1/students/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"\"Abigail\"","email":"abigale61@example.net\"","birthdate":"1978-04-22\""}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "\"Abigail\"",
    "email": "abigale61@example.net\"",
    "birthdate": "1978-04-22\""
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Retrieved successfully"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`PUT api/v1/students/{student_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `student_id` |  required  | The ID of the student.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  optional  | The name of the student.
        `email` | string |  optional  | The email of the student.
        `birthdate` | date |  optional  | Student's date of birth.
    
<!-- END_03e5de6d49d6faa8e56d64a8cb961e05 -->

<!-- START_b5f5a050fda5fa53b5bf90ab62d9ae27 -->
## delete($id)

Delete an existing Student

> Example request:

```bash
curl -X DELETE \
    "http://localhost/api/v1/students/8" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/students/8"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Deleted successfully"
}
```
> Example response (404):

```json
{
    "message": "Resource not found"
}
```

### HTTP Request
`DELETE api/v1/students/{student_id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `student_id` |  required  | The ID of the student.

<!-- END_b5f5a050fda5fa53b5bf90ab62d9ae27 -->


