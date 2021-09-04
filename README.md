### Note resource routes


```
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------------------+
| Domain | Method    | URI                 | Name          | Action                                                     | Middleware                                           |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------------------+
|        | GET|HEAD  | api/notes           | notes.index   | App\Http\Controllers\Api\NoteController@index              | api                                                  |
|        |           |                     |               |                                                            | Illuminate\Auth\Middleware\AuthenticateWithBasicAuth |
|        | POST      | api/notes           | notes.store   | App\Http\Controllers\Api\NoteController@store              | api                                                  |
|        |           |                     |               |                                                            | Illuminate\Auth\Middleware\AuthenticateWithBasicAuth |
|        | GET|HEAD  | api/notes/{note}    | notes.show    | App\Http\Controllers\Api\NoteController@show               | api                                                  |
|        |           |                     |               |                                                            | Illuminate\Auth\Middleware\AuthenticateWithBasicAuth |
|        | PUT|PATCH | api/notes/{note}    | notes.update  | App\Http\Controllers\Api\NoteController@update             | api                                                  |
|        |           |                     |               |                                                            | Illuminate\Auth\Middleware\AuthenticateWithBasicAuth |
|        | DELETE    | api/notes/{note}    | notes.destroy | App\Http\Controllers\Api\NoteController@destroy            | api                                                  |
|        |           |                     |               |                                                            | Illuminate\Auth\Middleware\AuthenticateWithBasicAuth |
|        | GET|HEAD  | api/user            |               | Closure                                                    | api                                                  |
|        |           |                     |               |                                                            | App\Http\Middleware\Authenticate:sanctum             |
+--------+-----------+---------------------+---------------+------------------------------------------------------------+------------------------------------------------------+

```

### Artisan commands:

`php artisan migrate && php artisan db:seed`


### Api CRUD commands for testing:

1. <p>Get all notes</p>

`curl -v http://localhost:8000/api/notes -H "Accept: application/json" -u "test1@test1.com:password" | less`

2. Get specific note

`curl -v http://localhost:8000/api/notes/3 -H "Accept: application/json" -u "test1@test1.com:password" | less`

3. <p>Create a note</p>

`curl --data "title=example_title_content&note=example_note_content"  -u "test1@test1.com:password" -v http://localhost:8000/api/notes | less`

4. <p>Update note using user who doesn't own the specific Note. Should return 403 Forbidden status.</p>

`curl -X PATCH --data "title=example_title_content_2" -v http://localhost:8000/api/notes/6 -H "Accept: application/json" -u "test2@test2.com:password" | less`

5. <p>Update note using user who owns the specific Note. Should return 202 Accepted status. </p>

`curl -X PATCH --data "title=example_title_content_2" -v http://localhost:8000/api/notes/6 -H "Accept: application/json" -u "test1@test1.com:password" | less`

6. <p>Delete note ID:6 for test2@tes2.com user. Should return Forbidden 403.</p>

`curl -X DELETE -v http://localhost:8000/api/notes/6 -H "Accept: application/json" -u "test2@test2.com:password" | less`

7. <p>Delete note ID:6 for test1@test1.com user</p>

`curl -X DELETE -v http://localhost:8000/api/notes/6 -H "Accept: application/json" -u "test1@test1.com:password" | less`



