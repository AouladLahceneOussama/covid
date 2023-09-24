const request = require('request');
const { MongoClient } = require("mongodb");

const type = process.argv[2];
const MyDateString = getCurrentDate();
const baseUrl = "https://raw.githubusercontent.com/AyatANSSAIEN/Covid19/main/";
const dbName = "covid19";

const client = new MongoClient("mongodb://127.0.0.1:27017");

request({
    url: baseUrl + type + ".json",
    json: true,
}, (err, response, body) => {
    if (err) {
        console.log("error data not fetched !");
        return;
    }
    if (response.statusCode == 200) updateOrCreate(body, type).catch(console.dir);
});

async function updateOrCreate(data, type) {
    switch (type) {
        case "data":
            return updateOrCreateData(data);
        case "regions":
            return updateOrCreateRegions(data);
        case "villes":
            return updateOrCreateCities(data);
        default:
            return null;
    }
}

async function updateOrCreateData(dataToInsert) {
    try {
        await client.connect();
        await client.db(dbName).command({ ping: 1 });
        console.log("Connected successfully to server");

        //to something
        var dataCollection = client.db(dbName).collection("data");

        //insert all data from API
        if (await dataCollection.countDocuments() == 0) {
            await dataCollection.insertMany(dataToInsert);
            return;
        }

        //update or insert in mongodb
        const query = { date: MyDateString };
        var update;
        for (var index in dataToInsert) {
            if (dataToInsert[index].date === MyDateString)
                update = { $set: dataToInsert[index] };
        }
        const options = { upsert: true };
        await dataCollection.updateOne(query, update, options);
    }
    finally {
        await client.close();
    }
}

async function updateOrCreateRegions(dataToInsert) {
    try {
        await client.connect();
        await client.db(dbName).command({ ping: 1 });
        console.log("Connected successfully to server");

        //to something
        var regionsCollection = client.db(dbName).collection("regions");
        var exist = false;

        //insert all data from API
        if (await regionsCollection.countDocuments() == 0) {
            await regionsCollection.insertMany(dataToInsert);
            return;
        }

        for (var b in dataToInsert) {
            for (var d in dataToInsert[b].data) {
                if (dataToInsert[b].data[d].date === MyDateString) {
                    var result = regionsCollection.find({ region_id: dataToInsert[b].region_id, "data.date": MyDateString });

                    while (await result.hasNext()) {
                        exist = true;
                        break;
                    }

                    if (exist) {
                        //update
                        await regionsCollection.updateOne({
                            region_id: dataToInsert[b].region_id
                        }, {
                            $set: { "data.$[dataItem].new_cases": dataToInsert[b].data[d].new_cases, "data.$[dataItem].death": dataToInsert[b].data[d].death },
                        }, {
                            arrayFilters: [{
                                "dataItem.date": MyDateString,
                            }]
                        });

                    } else {
                        //insert
                        await regionsCollection.updateOne({
                            region_id: dataToInsert[b].region_id
                        }, {
                            $push: { data: dataToInsert[b].data[d] },
                        });
                    }

                }
            }
        }
    }
    finally {
        await client.close();
    }
}

async function updateOrCreateCities(dataToInsert) {
    try {
        await client.connect();
        await client.db(dbName).command({ ping: 1 });
        console.log("Connected successfully to server");

        //to something
        var Collection = client.db(dbName).collection("villes");
        var exist = false;


        //insert all data from API
        if (await Collection.countDocuments() == 0) {
            await Collection.insertMany(dataToInsert);
            return;
        }

        for (var b in dataToInsert) {
            for (var d in dataToInsert[b].data) {
                if (dataToInsert[b].data[d].date === MyDateString) {
                    var result = Collection.find({ ville_id: dataToInsert[b].ville_id, "data.date": MyDateString });

                    while (await result.hasNext()) {
                        exist = true;
                        break;
                    }
                    if (exist) {
                        //update
                        await Collection.updateOne({
                            ville_id: dataToInsert[b].ville_id
                        }, {
                            $set: { "data.$[dataItem].new_cases": dataToInsert[b].data[d].new_cases, "data.$[dataItem].death": dataToInsert[b].data[d].death },
                        }, {
                            arrayFilters: [{
                                "dataItem.date": MyDateString,
                            }]
                        });

                    } else {
                        //insert
                        await Collection.updateOne({
                            ville_id: dataToInsert[b].ville_id
                        }, {
                            $push: { data: dataToInsert[b].data[d] },
                        });
                    }

                }
            }
        }
    }
    finally {
        await client.close();
    }
}

function getCurrentDate() {
    var MyDate = new Date();
    var MyDateString = '';

    MyDate.setDate(MyDate.getDate());

    var tempoMonth = (MyDate.getMonth() + 1);
    var tempoDate = (MyDate.getDate());

    if (tempoMonth < 10) tempoMonth = '0' + tempoMonth;
    if (tempoDate < 10) tempoDate = '0' + tempoDate;

    MyDateString = tempoDate + '/' + tempoMonth + '/' + MyDate.getFullYear();

    return MyDateString;
}