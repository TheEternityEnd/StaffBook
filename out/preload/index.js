"use strict";
const { contextBridge, ipcRenderer } = require("electron");
contextBridge.exposeInMainWorld("api", {
  /**
   * Envía las credenciales de login al proceso principal.
   * @param {string} username
   * @param {string} password
   * @returns {Promise<object>} - { success: boolean, message: string }
   */
  login: (username, password) => ipcRenderer.invoke("login", username, password),
  /**
   * Envía los datos de registro al proceso principal.
   * @param {object} userData - { userRegister, email, name, lastname, passRegister }
   * @returns {Promise<object>} - { success: boolean, message: string }
   */
  register: (userData) => ipcRenderer.invoke("register", userData),
  departamentoCrear: (data) => ipcRenderer.invoke("departamento:crear", data)
});
