import { reactive } from 'vue';
import axios from 'axios';
/**
 * @reactive {object} Данные аутентификации.
 */
const $auth = reactive({
    register(data) {
        return new Promise(function (resolve, reject) {
            axios.post('/api/register', data)
                // Удачная регистрация.
                .then(function (response) {
                    console.log(response);
                    this.token.setLocal(response.data.token);
                    this.user.setLocal(response.data.user);
                    resolve();
                }.bind(this))
                // Неудачная регистрация.
                .catch(function (error) {
                    console.log(error.response);
                    // Обрабатываем ошибки, которые прислал RegisterRequest.
                    let errors = null;
                    try {
                        errors = error.response.data.errors;
                    } catch { }
                    reject(errors);
                }.bind(this));
        }.bind(this));
    },
    logout() {
        return new Promise(function (resolve, reject) {
            axios.post('/api/logout')
                .then(function (response) {
                    console.log(response);
                    this.token.removeLocal();
                    this.user.removeLocal();
                    resolve();
                }.bind(this))
                .catch(function (error) {
                    reject();
                }.bind(this));
        }.bind(this));
    },
    login(data) {
        return new Promise(function (resolve, reject) {
            axios.post('/api/login', data)
                .then(function (response) {
                    console.log(response);
                    this.token.setLocal(response.data.token);
                    this.user.setLocal(response.data.user);
                    resolve();
                }.bind(this))
                .catch(function (error) {
                    console.log(error.response);
                    let errorInd = null;
                    try {
                        errorInd = error.response.data.error;
                    } catch { }
                    reject(errorInd);
                }.bind(this));
        }.bind(this));
    },
    getUser() {
        // Возвращаем объект Promise.
        return new Promise(function (resolve) {
            // ДО запроса на сервер считываем данные из локального хранилища браузера.
            this.token.getLocal();
            this.user.getLocal();

            // Если в локальном хранилище есть токен.
            if (this.token.has()) {
                // Запрос на сервер.
                axios.get('/api/user')
                    // В случае удачного отклика с сервера заполняем объект user данными с сервера.
                    .then(function (response) {
                        console.log(response);
                        this.user.setLocal(response.data.user);
                    }.bind(this))
                    // В случае неудачного отклика удаляем информацию о токене и пользователе
                    // из локального хранилища браузера.
                    .catch(function (error) {
                        console.log(error.response);
                        this.token.removeLocal();
                        this.user.removeLocal();
                    }.bind(this))
                    //
                    .finally(function () {
                        // Генерируем ответ объекта Promise.
                        resolve();
                    }.bind(this));
            }
            // Если в локальном хранилище нет токена.
            else {
                // Генерируем ответ объекта Promise.
                resolve();
            }
        }.bind(this));
    },
    // Авторизационный токен.
    token: {
        /**
         * Проверяет, существует ли токен.
         * @returns {boolean} Результат проверки.
         */
        has() {
            const token = localStorage.getItem('token');
            return typeof token === 'string' && token !== '';
        },
        /**
         * Получает токен из локального хранилища браузера.
         */
        getLocal() {
            const token = localStorage.getItem('token');
            if (typeof token === 'string' && token !== '') {
                this.setAxiosBearer(token);
            }
        },
        /**
         * Сохраняет токен в локальном хранилище браузера.
         * @param {string} token Токен.
         */
        setLocal(token) {
            localStorage.setItem('token', token);
            this.setAxiosBearer(token);
        },
        /**
         * Удаляет токен из локального хранилища браузера.
         */
        removeLocal() {
            localStorage.removeItem('token');
        },
        /**
         * Устанавливает HTTP-заголовок Authorization для библиотеки Axios.
         * @param {string} token Токен.
         */
        setAxiosBearer(token) {
            axios.defaults.headers.common['Authorization']
                = 'Bearer ' + token;
        }
    },
    // Пользователь.
    user: {
        // Свойства пользователя.
        // Если у вас есть дополнительные - добавьте их сюда.
        id: -1,
        name: '',
        surname: '',
        full_name: '',
        login: '',
        email: '',
        // Роль по умолчанию - посетитель (неавторизованный пользователь).
        role: 'guest',

        /**
         * Устанавливает свойства текущего объекта.
         * Применяется для входа и регистрации.
         * @param {object} user Пользователь.
         */
        set(user) {
            // Свойства пользователя.
            // Если у вас есть дополнительные - добавьте их сюда.
            this.id = user.id;
            this.name = user.name;
            this.surname = user.surname;
            this.full_name = user.full_name;
            this.login = user.login;
            this.email = user.email;
            this.role = user.role;
        },
        /**
         * Сбрасывает свойства текущего объекта до значений по умолчанию.
         * Применяется для выхода.
         */
        reset() {
            // Свойства пользователя.
            // Если у вас есть дополнительные - добавьте их сюда.
            this.id = -1;
            this.name = '';
            this.surname = '';
            this.full_name = '';
            this.login = '';
            this.email = '';
            this.role = 'guest';
        },
        /**
         * Получает пользователя из локального хранилища браузера.
         */
        getLocal() {
            let user = JSON.parse(localStorage.getItem('user'));
            if (typeof user === 'object' && user !== null) {
                this.set(user);
            }
        },
        /**
         * Сохраняет пользователя в локальном хранилище браузера.
         * @param {object} user Пользователь.
         */
        setLocal(user) {
            localStorage.setItem('user', JSON.stringify(user));
            this.set(user);
        },
        /**
         * Удаляет пользователя из локального хранилища браузера.
         */
        removeLocal() {
            localStorage.removeItem('user');
            this.reset();
        }
    },
});
$auth.getUser();
export default $auth;
