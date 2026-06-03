<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_library {
	protected $CI;

	public function __construct(){
    	$this->CI =& get_instance();
        $this->CI->load->library('migration');
    }
    public function create_migration($table_name='worldline_admin_data', $table_fields=null) {
        // Load the migration library
        $this->load->library('migration');

        // Define your migration name
        $migration_name = 'create_table_'.$table_name;

        // Generate a timestamp to include in the migration filename
        $timestamp = date('YmdHis');

        // Construct the migration filename
        $filename = $timestamp . '_' . $migration_name . '.php';

        // Define the migration class name
        $class_name = 'Migration_' . ucfirst($migration_name);

    
    	$table_fields = array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '100',
            ),
            'description' => array(
                'type' => 'TEXT',
            ),
            'created_at' => array(
                'type' => 'DATETIME',
                'default' => 'CURRENT_TIMESTAMP'
            ),
            // Add more fields as needed
        );
        // Define the migration code
        $migration_code = "<?php
class $class_name extends CI_Migration {

    public function up() {
        // Define your table creation logic here
        \$fields = $table_fields

        // Define primary key
        \$this->dbforge->add_key('id', TRUE);

        // Create the table
        \$this->dbforge->add_field(\$fields);
        \$this->dbforge->create_table('$table_name', TRUE);
    }

    public function down() {
        // Drop the table
        \$this->dbforge->drop_table('$table_name', TRUE);
    }
}";
        // Specify the path where migration files are stored
        $migration_path = APPPATH . 'database/migrations/';

        // Write the migration code to a new file
        if (!file_exists($migration_path . $filename)) {
            if (write_file($migration_path . $filename, $migration_code)) {
                echo "Migration file created successfully: " . $filename;
            } else {
                echo "Unable to create migration file.";
            }
        } else {
            echo "Migration file already exists.";
        }
    }
}

