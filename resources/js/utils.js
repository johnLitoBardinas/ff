export function formatBranchData (data){
    console.log('This is the format Branch');
    const updatedData = [];
    const users = [];
    let user = {};

    data.forEach((value, index) => {
        const userFields = ["user_id", "branch_id", "first_name", "last_name", "email", "mobile_number", "role_id"];
        if (userFields.includes(value.name)) {
            user[value.name] = value.value;
        } else {
            updatedData.push(value);
        }

        if (value.name === 'role_id') {
            users.push(user);
            user = {};
        }
    });

    updatedData.push({
        name: 'users',
        value: users
    });

    return updatedData;
};