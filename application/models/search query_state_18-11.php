    function get_search_sesults($where = array('p.status'=> 1)){
        //print_r(count($this->input->get('amenities'))); die();
        $address = explode(',', str_replace(', ', ',', $this->input->get('address')));
        $size = count($address);
        for ($i=0; $i < $size; $i++) {
            if($i == 0){
                $country = end($address);
                $country = $this->comman_model->get_single_row('countries',array('country_name' => $country));
                
                //$where['p.country'] = end($address);
                if($country){
                  $where['p.country'] = end($address);
                  unset($address[end(array_keys($address))]);
                  //$size++;  
                }else{
                   $size++; 
                }
                
            }
            if($i == 1){
                $where['p.state'] = end($address);
                if(strlen($where['p.state']) == 2){
                    $state = $this->comman_model->get_single_row('states',array('state_code' => $where['p.state']));
                    //$coords = explode('|', $state['coords']);
                    //$this->session->set_userdata('coords',$state['coords']);
                    //echo '<pre>'; print_r($coords);echo '</pre>';
                    $where['p.state'] = $state['state'];
                }
                unset($address[end(array_keys($address))]);
                break;
            }
             /*if($i == 2){
                $where['p.city'] = end($address);
                unset($address[end(array_keys($address))]);
                break;
            }
            if($i == 3){
                $where['p.address'] = implode(', ', $address);
                break;
            }*/
        }
        //echo '<pre>'; print_r($where); die();
        if($this->input->get('check-in') != ''){
            //echo strtotime($this->input->get('check-in')); die();
            $where['p.date_from >='] = strtotime($this->input->get('check-in'));
        }
        if($this->input->get('check-out') != ''){
            //echo strtotime($this->input->get('check-out')); die();
            $where['p.date_to <='] = strtotime($this->input->get('check-out'));
        }
        
        if($this->input->get('min') != ''){
            $where['p.price >= '] = $this->input->get('min');
        }
        if($this->input->get('max') != ''){
            $where['p.price <='] = $this->input->get('max');
        }
//======================================
        if($this->input->get('pets_allowed') != ''){
            $where['p.pets_allowed'] = $this->input->get('pets_allowed');
        }

        if($this->input->get('parking') != ''){
            $where['p.parking'] = $this->input->get('parking');
        }

        if($this->input->get('area') != ''){
            $where['p.area'] = $this->input->get('area');
        }

        if($this->input->get('bathrooms') != ''){
            $where['p.bathrooms'] = $this->input->get('bathrooms');
        }

        if($this->input->get('bedrooms') != ''){
            $where['p.bedrooms'] = $this->input->get('bedrooms');
        }
//=====================================     
        $this->db->select('p.*,pimg.image')
            ->from('properties as p')
            ->join('property_images as pimg','pimg.property_id = p.property_id && pimg.type = 1','left')
            ->where($where);
//===================================== 
        
       if($this->input->get('amenities') != ''){
           $ameniti = $this->input->get('amenities');
            
            for ($i=0; $i < count($ameniti) ; $i++) { 
                $this->db->like('amenities', $ameniti[$i]);
            }
        }   
        
        /*if($this->input->get('amenities') != ''){
            $ameniti = $this->input->get('amenities');
            $this->db->like('amenities', $ameniti[0]);
            for ($i=1; $i < count($ameniti) ; $i++) { 
                $this->db->or_like('amenities', $ameniti[$i]);
            }
        }*/
//=====================================
                $this->db->group_by('p.property_id');   
                $this->db->order_by('p.created', 'desc');
                $query =  $this->db->get();
       
       if($query->num_rows() > 0)
            return $query->result_array();
       return false;
    }