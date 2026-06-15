$this->db
    ->table('logs')
    ->where(
        'created_at <',
        date(
            'Y-m-d',
            strtotime('-180 days')
        )
    )
    ->delete();