from authtests import session, test_login

BASE_URL = "http://localhost:80/ecommerce/routes/user.php"

test_login()
def test_get_user():
    url = BASE_URL
    response = session.get(url)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)
def test_update_user():
    url = BASE_URL
    data = {
        "name": "John Doe",
        "email": "joaogabriel@example.com",
    }
    response = session.put(url, json=data)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)
def test_delete_user():
    url = BASE_URL
    response = session.delete(url, json={"email": "luizmtca@gmail.com"})
    print("STATUS:", response.status_code)
    print("BODY:", response.text)


test_get_user()
test_update_user()
test_delete_user()