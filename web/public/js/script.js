window.onload = function()
{
    let date = new Date();

    let month_name = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre'];

    let month = month_name.getMonth();

    let year = month_name.getFullYear();

    let first_date = month_name[month] + " " + 1 + " " + year;

    let tmp = new Date(first_date).toDateString();

    let first_day = tmp.substring(0, 3);

    let day_name = ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'];

    let day_number = day_name.indexOf(first_day);

    let days = new Date(year, month + 1, 0).getDate();

    let calendar = get_calendar(day_number, days);
    
    document.getElementById("calendar-month-year").innerHTML = month_name[month]+ " " +year;
    document.getElementById("calendar-dates").appendChild(calendar);
}

function get_calendar(day_number, days)
{
    let table = document.createElement('table');
    let tr = document.createElement('tr');

    // Row for the day letters
    for(let i = 0; i <= 6; i++)
    {
        let td = document.createElement('td');
        td.innerHTML = "LMMJVSD"[i];
        tr.appendChild(td);
    }

    table.appendChild(tr);

    //Second row
    let tr = document.createElement('tr');
    let createElement;

    for(c = 0; c <= 6; c ++)
    {
        if (c == day_number)
        {
            break;
        }

        let td = document.createElement('td');
        td.innerHTML = "";
        tr.appendChild(td);
    }

    let count = 1;

    for(; c <= 6; c++)
    {
        var td = document.createElement('td');
        td.innerHTML = count;
        count++;
        tr.appendChild(td);
    }

    table.appendChild(tr);

    // Rest of the date rows
    for (var r = 3; r <= 6; r++)
    {
        var tr = document.createElement('tr');
        for(var c = 0; c <= 6; c++)
        {
            if(count > days)
            {
                table.appendChild(tr);
                return table;
            }
            var td = document.createElement('td');
            td.innerHTML = count;
            count++;
            tr.appendChild(td);

        }
        table.appendChild(tr);
    }

}