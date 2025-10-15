// Se importan los modulos con la sintaxis de CommonJS
const {app, BrowserWindow} = require('electron');

app.whenReady().then(() => {
    const win = new BrowserWindow({
        width: 800,
        height: 600,
        webPreferences: {
            nodeIntegration: true
        }
    });

    win.maximize();
    win.show();
    win.loadFile('public/index.html');
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});