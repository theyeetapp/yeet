module.exports = {
    purge: [],
    theme: {
      screens:{
          xs:'340px',
          bsx:'390px',
          sm:'576px',
          bsm:'610px',
          md:'769px',
          bmd:'810px',
          lg:'1025px',
          xl:'1280px'
      },
      extend: {
          colors:{
              'yeet-blue':'#25326E',
              'yeet-light-blue':'#1D439B',
              'yeet-medium-blue':'#3D518C',
              'steel-blue':"#B4C5E4",
              'light-gray':'#FBFBFB',
              'red':'#FF0000'
          },
          height:{
              '1/2':'50%',
              '1/4':'25%',
              '3/4':'75%',
              '1/5':'20%',
              '2/5':'40%',
              '3/5':'60%',
              '4/5':'80%',
              '1/6':'16.67%',
              '2/6':'33.33%',
              '4/6':'66.67%',
              '5/6':'83.33%'
          },
          width:{
              '3/7':'42%'
          }
      },
    },
    variants: {},
    plugins: [],
  }