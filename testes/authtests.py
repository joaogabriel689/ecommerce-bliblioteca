import requests

BASE_URL = "http://localhost:80/ecommerce/routes/auth"
session =   requests.Session()

def test_register():
    url = f"{BASE_URL}/register.php"
    payload = {
        "nome": "joao gabriel",
        "cpf": "07486556111",
        "email": "joaogabriel@example.com",
        "password": "testpassword",
        "data_nascimento": "1990-01-01",
        "phone": "6799240458"
    }
    response = session.post(url, json=payload)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)

def test_login():
    url = f"{BASE_URL}/login.php"
    payload = {
        "email": "joaogabriel@example.com",
        "password": "testpassword"
    }
    response = session.post(url, json=payload)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)
def me():
    url = f"{BASE_URL}/me.php"
    response = session.get(url)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)
def test_logout():
    url = f"{BASE_URL}/logout.php"
    response = session.post(url)
    print("STATUS:", response.status_code)
    print("BODY:", response.text)
test_register()
test_login()
me()
test_logout()