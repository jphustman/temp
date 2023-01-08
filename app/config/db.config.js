module.exports = {
    HOST: "localhost",
    USER: "leagues",
    PASSWORD: "LeaguesDB!",
    DB: "leaguesdb",
    dialect: "mysql",
    pool: {
        max: 5,
        min: 0,
        acquire: 30000,
        idle: 10000
    }
};