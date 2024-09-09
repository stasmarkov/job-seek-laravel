class User {
  constructor(attributes = {}) {
    Object.assign(this, attributes);
  }

  isLoggedIn() {
    return Boolean(this.name);
  }
}

export default User;
