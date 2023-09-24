const cron = require('node-cron');
let shell = require('shelljs');

let supportedTypes = ['data', 'regions', 'villes'];

cron.schedule("* * * * * *", () => {
    console.log("Running cron job");
    for (let type of supportedTypes) {
        if (shell.exec(`node index.js ${type}`).code !== 0) {
            console.log(`${type} updated`);
        }
    }
});