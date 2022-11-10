<?php
class Statistic_model extends CI_Model {

    //get all customer
    public function get_customers (){
     $query = $this->db->get('customers');
        return $query->result_array();
    }

    
    //get top 3 customer by number of order
    public function get_top_customers (){
        $select =   array(
            'customers.customerName',
            'customers.address',
            'count(orders.customerID) as Total'
        ); 
        $query = $this->db->select($select)
        ->limit(3)
        ->from('customers')
        ->join('orders','orders.customerID = customers.customerID','left')
        ->group_by('customers.customerID')
        ->order_by('Total','desc')
        ->having('count(orders.customerID) > 0')
        ->get();
        return $query->result_array();

         // not completed query
        // $this->db->select('customerName, address');
        // $this->db->from('customers');
        // $this->db->join('orders', 'orders.customerID = customers.customerID');
        // $query = $this->db->get();

    //another query 
    // $this->db->select('SalerName, count(*)');
    // $this->db->from('tblSaler');        
    // $this->db->join('tblProduct', 'tblSaler.SalerID = tblProduct.SalerID'); 
    // $this->db->group_by('tblSaler.SalerID');       
    // $query = $this->db->get();

       }



    // get the last order date
    public function get_orders (){
        $this->db->select_max('orderDate');
        $query = $this->db->get('orders'); 
        return  $query->result_array();
       }

    // get the best customer
    public function get_best_customer (){
        $select =   array(
            'customers.customerName',
            'count(orders.customerID) as Total'
        ); 
        $query = $this->db->select($select)
        ->limit(1)
        ->from('customers')
        ->join('orders','orders.customerID = customers.customerID','left')
        ->get();
        return $query->result_array();
       }

    //get the 3 most popular product
    // between order details and products table
    public function get_most_seller_products(){
        $select =   array(
            'products.productName',
            'count(orderdetails.productID) as Total'
        ); 
        $query = $this->db->select($select)
        ->limit(3)
        ->from('products')
        ->join('orderdetails','orderdetails.productID = products.productID','left')
        ->group_by('products.productID')
        ->order_by('Total','desc')
        ->get();
        return $query->result_array();
    }

        //get the most popular product
        // between order details and products table
        public function get_most_popular_product(){
            $select =   array(
                'products.productName',
                'count(orderdetails.productID) as Total'
            ); 
            $query = $this->db->select($select)
            ->limit(1)
            ->from('products')
            ->join('orderdetails','orderdetails.productID = products.productID','left')
            ->group_by('products.productID')
            ->order_by('Total','desc')
            ->get();
            return $query->result_array();
        }
    
    
    //get the name of product and thier quantity
    public function get_products (){
        $query = $this->db->get('products');
        return $query->result_array();
        //changes
        // $query = $this->db->select('productName','quantity')
        // ->from('products')
        // ->order_by('quantity','desc')
        // ->get();
        // return $query->result_array();

        //$data['products'] = json_encode($query->result_array());
        // return $data;
       }


       //get the stocks running out soon
        public function get_running_out(){
            $select =   array(
                'productName',
                'quantityP'
            ); 
            $query = $this->db->select($select)
            ->limit(1)
            ->from('products')
            ->group_by('products.productID')
            ->order_by('products.quantityP','asc')
            ->get();
            return $query->result_array();
        }


}