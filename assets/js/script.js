import * as User from "./Api/UserApi.js";
import * as Direction from "./Api/DirectionApi.js";

let dir1 = await Direction.getDirection(4);
User.createUser('anton', '12345', 5000, 'foto.png', dir1, [], 'anton@gmail.com', 'administrador');