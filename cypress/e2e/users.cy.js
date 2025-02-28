describe("User Management API Tests", () => {
  const apiUrl = "http://localhost:8888/testunit/src";

  it("should add a user", () => {
    cy.request("POST", `${apiUrl}`, {
      name: "John Doe",
      email: "johndoe@example.com",
    }).then((response) => {
      expect(response.status).to.eq(200);
    });
  });

  it("should fetch all users", () => {
    cy.request("GET", `${apiUrl}`).then((response) => {
      expect(response.status).to.eq(200);
    });
  });

  it("should fetch a single user", () => {
    cy.request("GET", `${apiUrl}`).then((response) => {
      expect(response.status).to.eq(200);
    });
  });

  it("should update a user", () => {
    cy.request("PUT", `${apiUrl}`, {
      name: "Jane Doe",
      email: "janedoe@example.com",
    }).then((response) => {
      expect(response.status).to.eq(200);
    });
  });

  it("should delete a user", () => {
    cy.request("DELETE", `${apiUrl}`).then((response) => {
      expect(response.status).to.eq(200);
    });
  });
});
