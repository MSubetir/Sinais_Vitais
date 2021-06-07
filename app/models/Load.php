<?php
class Load {
    private $db;
    public function __construct() {
        $this->db = new Database;
    }

    
    public function simple_table() {
        $this->db->query('select *, 
        DATE(date) as data, TIME(date) as hora
        from users as us
        INNER JOIN usersxhistories as ushi
        ON us.idUser = ushi.IdUser
        INNER JOIN histories as hi
        ON ushi.IdHistory = hi.IdHistory
        WHERE DATEDIFF(NOW(),date) <= 7
        ORDER BY date DESC');

        $result = $this->db->resultSet();
        return $result;
    }

    public function user_table($user_id, $dias) {
        $this->db->query('select *, 
        DATE(date) as data, TIME(date) as hora
        from users as us
        INNER JOIN usersxhistories as ushi
        ON us.idUser = ushi.IdUser
        INNER JOIN histories as hi
        ON ushi.IdHistory = hi.IdHistory
        where us.IdUser = :user_id
        AND DATEDIFF(NOW(),date) <= :dias
        ORDER BY date DESC');
        
        $this->db->bind(':user_id', $user_id);    
        $this->db->bind(':dias', $dias);   

        $result = $this->db->resultSet();
        return $result;
    }

    public function highlights() {
        $this->db->query('  
        select us.IdUser, us.diagnosticos_numero, us.name, us.idade, hi.O2, hi.BPM, hi.TEMPERATURA,hi.date,
        IF(hi.TEMPERATURA > ns.TEMPERATURA_max, "high", IF(hi.TEMPERATURA<ns.TEMPERATURA_min, "low", "normal")) as temp_desc,
        IF(hi.BPM > ns.BPM_max, "high", IF(hi.BPM < ns.BPM_min, "low", "normal")) as bpm_desc,
        IF(hi.O2 < ns.O2_min, "low", "normal") as o2_desc
        from users as us
        INNER JOIN usersxhistories as ushi
            ON us.idUser = ushi.IdUser
        INNER JOIN histories as hi
            ON ushi.IdHistory = hi.IdHistory
        INNER JOIN normalsigns as ns
            ON us.idade >= ns.idade and us.idade - ns.idade < 10
        WHERE hi.BPM < ns.BPM_min or hi.BPM > ns.BPM_max OR
        hi.O2 < ns.O2_min OR
        hi.TEMPERATURA < ns.TEMPERATURA_min or hi.TEMPERATURA > ns.TEMPERATURA_max
        
        ORDER BY hi.date DESC LIMIT 6');

        $result = $this->db->resultSet();
        return $result;
    }

    public function user_alert($id) {
        $this->db->query('
        select *, hi.date as data_sinal,
        IF(hi.TEMPERATURA > ns.TEMPERATURA_max, "high", IF(hi.TEMPERATURA<ns.TEMPERATURA_min, "low", "normal")) as temp_desc,
        IF(hi.BPM > ns.BPM_max, "high", IF(hi.BPM < ns.BPM_min, "low", "normal")) as bpm_desc,
        IF(hi.O2 < ns.O2_min, "low", "normal") as o2_desc
        from users as us
        INNER JOIN usersxhistories as ushi
            ON us.idUser = ushi.IdUser
        INNER JOIN histories as hi
            ON ushi.IdHistory = hi.IdHistory
        INNER JOIN normalsigns as ns
            ON us.idade >= ns.idade and us.idade - ns.idade < 10
        
        WHERE hi.BPM < ns.BPM_min AND us.IdUser = :id or hi.BPM > ns.BPM_max AND us.IdUser = :id OR
        hi.O2 < ns.O2_min AND us.IdUser = :id OR
        hi.TEMPERATURA < ns.TEMPERATURA_min AND us.IdUser = :id or hi.TEMPERATURA > ns.TEMPERATURA_max AND us.IdUser = :id
        ORDER BY hi.date DESC
        ');
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
    }

    public function graph_data($user_id, $dias) {
        $this->db->query('SELECT 
        DATE(date) as date,
        COUNT(DATE(date)),
        BPM,
        TEMPERATURA,
        O2
        FROM
        histories as hi
        INNER JOIN usersxhistories as ushi
        ON hi.IdHistory = ushi.IdHistory
        WHERE ushi.IdUser = :user_id
        AND DATEDIFF(NOW(),date) <= :dias
        GROUP BY DATE(date)
        HAVING COUNT(DATE(date)) = 1
        
        UNION
        
        SELECT 
        DATE(date) as date,
        COUNT(DATE(date)),
        avg(BPM) as BPM,
        avg(TEMPERATURA) as TEMPERATURA,
        avg(O2) as O2
        FROM
        histories as hi
        INNER JOIN usersxhistories as ushi
        ON hi.IdHistory = ushi.IdHistory
        WHERE ushi.IdUser = :user_id
        AND DATEDIFF(NOW(),date) <= :dias
        GROUP BY DATE(date)
        HAVING COUNT(DATE(date)) > 1
        
        ORDER BY DATE(date)');

        $this->db->bind(':user_id', $user_id);    
        $this->db->bind(':dias', $dias); 

        $result = $this->db->resultSet();
        return $result;
    }

 
}
